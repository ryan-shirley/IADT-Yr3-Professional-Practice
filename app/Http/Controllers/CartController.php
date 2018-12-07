<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;
use App\Cart;
use App\Address;
use App\ShippingMethod;
use App\Event;
use App\Card;
use Validator;

class CartController extends Controller
{

    public function view(Request $request)
    {
        $cart = $this->getCart($request);

        return view('cart.view')->with([
            'cart' => $cart
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('alert-error', 'Invalid request');
            return redirect()->back();
        }
        else {
            $product_id = $request->input('product_id');
            $product = Product::find($product_id);

            $cart = $this->getCart($request);
            $cart->add($product, 1);

            $request->session()->flash('alert-success', $product->name . ' was added to your cart!');
            return redirect()->back();
        }
    }

    public function edit(Request $request)
    {
        $cart = $this->getCart($request);

        return view('cart.edit')->with([
            'cart' => $cart
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:0'
        ]);

        $cart = $this->getCart($request);
        $quantities = $request->input('quantity');
        foreach ($quantities as $product_id => $quantity) {
            $product = Product::findOrFail($product_id);
            $cart->update($product, $quantity);
        }

        $request->session()->flash('alert-success', 'Your cart was updated!');
        return redirect()->route('cart.view');
    }

    public function remove(Request $request) {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('alert-error', 'Invalid request');
            return redirect()->back();
        }
        else {
            $product_id = $request->input('product_id');
            $product = Product::find($product_id);

            $cart = $this->getCart($request);
            $cart->remove($product);

            $request->session()->flash('alert-success', $product->name . ' was removed from your cart!');
            return redirect()->back();
        }
    }

    public function checkout(Request $request)
    {
        $cart = $this->getCart($request);

        // Check if cart is empty if so redirect to cart page
        if($cart->isEmpty()) {
            $request->session()->flash('alert-warning', ' Your cart is empty!');
            return redirect()->route('shop.home');
        }

        $user = Auth::user();
        if($user == null) {
            // Store Route to Checkout as user intends to purchase
            $request->session()->put('url.intended', route('cart.checkout'));
            return redirect()->route('login');
        }


        $shipping_methods = ShippingMethod::all();

        return view('cart.checkout')->with([
          'cart' => $cart,
          'user' => $user,
          'shipping_methods' => $shipping_methods
        ]);
    }

    public function pay(Request $request) {
        //dd($request);
        $timestamp = date("h:i:a");

        $request->validate([
            'shipping_id' => 'required|integer|min:0',
            'shipping_address_line1' => 'required_if:shipping_id,0|nullable|string|max:100',
            'billing_id' => 'required|integer|min:0',
            'billing_address_line1' => 'required_if:billing_id,0|nullable|string|max:100',
            'shipping_method_id' => 'required|exists:shipping_methods,id|max:10',
            'card_id' => 'required|integer|min:0',
            'card_number' => 'required_if:card_id,0',
            'card_holder_name' => 'required_if:card_id,0|max:100',
            'expiry' => 'required_if:card_id,0|max:100',
        ]);

        $user = Auth::user();

        // Check shipping address is the users address or create new
        $shipping_address_id = $request->input('shipping_id');

        if ($shipping_address_id == 0) {
            $shipping_address = new Address();
            $shipping_address->line1 = $request->input('shipping_address_line1');;
            $shipping_address->shipping = true;
            $shipping_address->user_id = $user->id;
            $shipping_address->save();
        }
        else {
            $shipping_address = Address::findOrFail($shipping_address_id);

            if ($shipping_address->user->id != $user->id) {
                return response(401, 'Unauthorised');
            }
        }

        // Check billing address is the users address
        $billing_address_id = $request->input('billing_id');
        if ($billing_address_id == 0) {
            $billing_address = new Address();
            $billing_address->line1 = $request->input('billing_address_line1');;
            $billing_address->billing = true;
            $billing_address->user_id = $user->id;
            $billing_address->save();
        }
        else {
            $billing_address = Address::findOrFail($billing_address_id);

            if ($billing_address->user->id != $user->id) {
                return response(401, 'Unauthorised');
            }
        }


        $credit_card_id = $request->input('card_id');
        if ($credit_card_id == 0) {
            $request->validate([
                'name_on_card' => 'nullable|string|max:100',
                'number' => 'nullable|digits:16',
                'expiry' => 'nullable|regex:/[0-9]{2}\/[0-9]{2}/'
            ]);

            $card = new Card();
            $card->name_on_card = $request->input('name');
            $card->number = $request->input('card_number');
            $card->expiry = $request->input('expiry');
            $card->user_id = $user->id;
            $card->save();
        }
        else {
            $card = Card::findOrFail($credit_card_id);
            if ($card->user_id != $user->id) {
                return response(401, 'Unauthorised');
            }
        }

        // Create order
        $order = new Order();
        $order->user_id = $user->id;
        $order->order_date = date("Y-m-d");
        $order->payment_status = 'paid';
        $order->shipping_address = $shipping_address->line1;
        $order->billing_address = $billing_address->line1;
        $order->shipping_method_id = $request->input('shipping_method_id');
        $order->save();

        // Attach product to order
        $cart = $this->getCart($request);
        foreach ($cart->getItems() as $item) {
            $order->products()->attach($item->getProduct()->id, [
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice()]
            );

            $product = Product::findOrFail($item->getProduct()->id);
            $product->stock += -$item->getQuantity();
            $product->save();
        }

        $event = new Event();
        $event->name = 'A new order was create on ' . date("d M Y") . ' at ' . $timestamp . '.';
        $event->order_id = $order->id;
        $event->save();

        $event = new Event();
        $event->name = 'A €' . $order->total() . ' EUR payment was processed on ' . date("d M Y") . ' at ' . $timestamp . '.';
        $event->order_id = $order->id;
        $event->save();

        // Reset Cart
        $cart->removeAll();

        return redirect()->route('checkout.confirmation', $order);
    }

    private function getCart(Request $request) {
        $cart = $request->session()->get('cart', null);
        if ($cart == null) {
            $cart = new ShoppingCart();
            $request->session()->put('cart', $cart);
        }
        return $cart;
    }


    public function confirmation($id) {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        if ($order->user->id != $user->id) {
            return response(401, 'Unauthorised');
        }

        return view('cart.confirm')->with([
            'order' => $order
        ]);
    }


}
