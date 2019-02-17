<?php

namespace App\Http\Controllers\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Role;
use App\ShippingMethod;
use App\Event;
use App\Product;

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
        $role = Role::where('name', 'customer')->first();
        $users = $role->users;
        $shippings = ShippingMethod::all();
        $products = Product::all();

        return view('artist.orders.create')->with([
          'users' => $users,
          'shippings' => $shippings,
          'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
         'quantity.*' => [
             'nullable',
             'integer',
             'min:0',
             function($attribute, $quantity, $fail) {
                 $parts = explode('.', $attribute);
                 $product_id = $parts[1];
                 $product = Product::find($product_id);
                 if ($product == null) {
                     $error = "Product not found";
                     return $fail($error);
                 }
                 else {
                     if ($product->stock < $quantity) {
                          $error = "Product stock level too low";
                          return $fail($error);
                     }
                 }
             }
           ],
         'quantity' => [
             'required',
             'min:1', // make sure the input array is not empty <= edited
             'array',
         ],
        ];

        $validator = Validator::make($request->all(), $rules);
        //dd($request->all());

        // $validator = Validator::make($request->all(), [
        //     'user_id' => 'required|exists:users,id',
        //     'quantity' => 'required|array',
        //     'quantity.*' => 'integer|min:0',
        //     'fulfillment_date' => 'required|date',
        //     'payment_status' => 'required',
        //     'fulfillment_status' => 'required',
        //     'shipping_address' => 'required|max:100',
        //     'billing_address' => 'required|max:100',
        //     'shipping_method_id' => 'required|max:10'
        // ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator)->withInput();
        }

        $order = new Order();
        $order->user_id = $request->input('user_id');
        $order->order_date = date("d") . '-' .date("m") . '-' . date("y");
        $order->order_time = date("h:i");
        $order->payment_status = $request->input('payment_status');
        $order->shipping_address = $request->input('shipping_id');
        $order->billing_address = $request->input('billing_id');
        $order->shipping_method_id = $request->input('shipping_method_id');
        $order->save();

        $event = new Event();
        $event->name = 'A new order was create on ' . date("d M Y") . ' at ' . date("h:i:a") . '.';
        $event->order_id = $order->id;
        $event->save();

        return redirect()->route('orders.index');
    }

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
