<?php

namespace App\Http\Controllers\Artist;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $shippings = ShippingMethod::all();

        return view('artist.orders.create')->with(['users' => $users, 'shippings' => $shippings]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'fulfillment_date' => 'required|date',
            'payment_status' => 'required',
            'fulfillment_status' => 'required',
            'shipping_address' => 'required|max:100',
            'billing_address' => 'required|max:100',
            'shipping_method_id' => 'required|max:10'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $order = new Order();
        $order->user_id = $request->input('user_id');
        $order->order_date = date("d") . '-' .date("m") . '-' . date("y");
        $order->order_time = date("h:i");
        $order->fulfillment_date = $request->input('fulfillment_date');
        $order->payment_status = $request->input('payment_status');
        $order->fulfillment_status = $request->input('fulfillment_status');
        $order->shipping_address = $request->input('shipping_address');
        $order->billing_address = $request->input('billing_address');
        $order->shipping_method_id = $request->input('shipping_method_id');
        $order->save();

        $event = new Event();
        $event->name = 'A new order was create on ' . date("d M Y") . ' at ' . date("h:i:a") . '.';
        $event->order_id = $order->id;
        $event->save();

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('artist.orders.show')->with([
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
