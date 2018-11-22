<?php

namespace App\Http\Controllers\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Product;
use App\ShippingMethod;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:artist');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $orders = Order::all();

        return view('artist.home')->with([
            'orders' => $orders,
            'products' => $products
        ]);
    }

    public function settings()
    {
        return view('artist.settings');
    }
}
