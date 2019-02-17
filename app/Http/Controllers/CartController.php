<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;
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
        $timestamp = date("h:i:a");

        $request->validate([
            'shipping_id' => 'required|integer|exists:addresses,id',
            'billing_id' => 'required|integer|exists:addresses,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'card_id' => 'required|integer|exists:cards,id',
        ]);

        $user = Auth::user();

        // Check shipping address is the users address
        $shipping_address_id = $request->input('shipping_id');
        $shipping_address = Address::findOrFail($shipping_address_id);
        // Check billing address is the users address
        $billing_address_id = $request->input('billing_id');
        $billing_address = Address::findOrFail($billing_address_id);
        // Check card is the users card
        $credit_card_id = $request->input('card_id');
        $card = Card::findOrFail($credit_card_id);

        // If addresss or card is not the users
        if ($shipping_address->user->id != $user->id || $billing_address->user->id != $user->id || $card->user_id != $user->id) {
            return response(401, 'Unauthorised');
        }

        // Create order
        $order = new Order();
        $order->user_id = $user->id;
        $order->order_date = date("Y-m-d");
        $order->order_time = date("h:i:s");
        $order->payment_status = 'paid';
        $order->shipping_address = $shipping_address->line1;
        $order->billing_address = $billing_address->line1;
        $order->shipping_method_id = $request->input('shipping_method_id');
        $order->save();

        // Attach products to order
        $cart = $this->getCart($request);
        foreach ($cart->getItems() as $item) {
            $order->products()->attach($item->getProduct()->id, [
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice()]
            );

            $product = Product::findOrFail($item->getProduct()->id);
            $product->stock -= $item->getQuantity();
            $product->save();
        }

        // Create events for the order timeline
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
