<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\ShippingMethod;
use App\Event;
use Validator;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:customer');
    }
    public function index()
    {
        $orders = Order::all();

        return view('customer.orders.index')->with([
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('customer.orders.show')->with([
            'order' => $order
        ]);
    }
}
