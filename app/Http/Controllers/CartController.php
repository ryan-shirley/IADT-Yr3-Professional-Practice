<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Validator;

class CartController extends Controller
{

    public function view(Request $request)
    {
        $cart = $this->getCart($request);

        return view('shop.cart.view')->with([
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

        return view('shop.cart.edit')->with([
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

    }

    public function pay(Request $request) {

    }

    private function getCart(Request $request) {
        $cart = $request->session()->get('cart', null);
        if ($cart == null) {
            $cart = new ShoppingCart();
            $request->session()->put('cart', $cart);
        }
        return $cart;
    }



















    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart');
        $items = $cart->getItems();

        //dd($items);

        return view('shop.cart')->with([
            'items' => $items,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        session_start();

        try {
            if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
                echo 'no product id';
                return back()->withErrors("Product id required.");
            }

            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
            }
            else {
                $cart = new ShoppingCart();
                $_SESSION['cart'] = $cart;
            }

            $cart->addToCart($_GET['product_id'], 1);

            $request->session()->put('cart', $cart);

            return redirect()->back();
            // header('Location: ' $request->headers->get('referer'));
        }
        catch (Exception $ex) {
            $errorMessage = $ex->getMessage();
            require 'viewBooks.php';
        }
    }
}
