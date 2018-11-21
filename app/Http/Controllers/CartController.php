<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;
use App\Cart;
use App\Address;
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
        $user = Auth::user();
        if($user == null) {
            // Store Route to Checkout as user intends to purchase
            $request->session()->put('url.intended', route('cart.checkout'));
            return redirect()->route('login');
        }

        $cart = $this->getCart($request);

        // ****************************
        // ****************************
        // ****************************
        // ****************************
        // Check if cart is empty if so redirect to cart page

        return view('cart.checkout')->with([
          'cart' => $cart,
          'user' => $user
        ]);
    }

    public function pay(Request $request) {

        // ****************************
        // ****************************
        // ****************************
        // ****************************
        // If user reloads page they will get submit form again
        // How to best manage this?

        return view('cart.confirm')->with([

        ]);
    }

    private function getCart(Request $request) {
        $cart = $request->session()->get('cart', null);
        if ($cart == null) {
            $cart = new ShoppingCart();
            $request->session()->put('cart', $cart);
        }
        return $cart;
    }

}
