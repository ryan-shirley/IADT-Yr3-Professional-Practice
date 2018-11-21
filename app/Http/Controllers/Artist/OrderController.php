<?php

namespace App\Http\Controllers\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\ShippingMethod;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:artist');
    }

    public function index()
    {
        $orders = Order::all();

        return view('artist.orders.index')->with([
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('artist.orders.show')->with([
            'order' => $order
        ]);
    }

}
