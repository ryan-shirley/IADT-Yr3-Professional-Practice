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
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:artist');
    }

    /**
     *  Returns a view with the orders and products
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
    /**
     *  Returns a view to settings
     */
    public function settings()
    {
        return view('artist.settings');
    }
}
