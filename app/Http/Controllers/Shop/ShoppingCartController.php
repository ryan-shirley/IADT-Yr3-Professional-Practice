<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
require_once 'ShoppingCart.php';
use App\Product;

class ShoppingCartController extends Controller
{
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
