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
use App\Shipment;
use App\Address;

use Validator;

class OrderController extends Controller
{

     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('role:artist');
     }
     /**
      *  Returns all orders
      */
     public function index()
     {
         $orders = Order::all();

         return view('artist.orders.index')->with([
             'orders' => $orders
         ]);
     }

     /**
      *  Returns a view to create order with the users, shippings and products
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
     *  Stores an order in the DB
     */
    public function store(Request $request)
    {
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
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:0',
            'fulfillment_date' => 'date',
            'payment_status' => 'required',
            'shipping_address' => 'required|max:100',
            'billing_address' => 'required|max:100',
            'shipping_method_id' => 'required|max:10'
        ];

        $messages = [
            'shipping_method_id.required' => 'Please select a shipping method.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            //dd($validator->errors());
            return back()->withErrors($validator)->withInput();
        }

        // Check shipping address is the users address
        $shipping_address_id = $request->input('shipping_address');
        $shipping_address = Address::findOrFail($shipping_address_id);
        // Check billing address is the users address
        $billing_address_id = $request->input('billing_address');
        $billing_address = Address::findOrFail($billing_address_id);
        
        $order = new Order();
        $order->user_id = $request->input('user_id');
        $order->order_date = date("Y-m-d");
        $order->order_time = date("h:i:s");
        $order->payment_status = $request->input('payment_status');
        $order->shipping_address = $shipping_address->line1;
        $order->billing_address = $billing_address->line1;
        $order->shipping_method_id = $request->input('shipping_method_id');
        $order->save();

        $quantity = $request->input('quantity');
        foreach($quantity as $id => $qty) {
          $p = Product::select('price')->where('id', $id)->first();
          if ($qty != 0) {
              $order->products()->attach($id,
                  [
                    'quantity' => $qty,
                    'price' => $p->price
                  ]
              );
          }
        }

        $event = new Event();
        $event->name = 'A new order was create on ' . date("d M Y") . ' at ' . date("h:i:a") . '.';
        $event->order_id = $order->id;
        $event->save();

        return redirect()->route('orders.index');
    }
    /**
     *  Returns an order
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('artist.orders.show')->with([
            'order' => $order
        ]);
    }

    /**
     *  Returns a view to edit an order
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('artist.orders.edit')->with([
            'order' => $order
        ]);
    }

    /**
     *  Updates an order in the DB
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:paid,unpaid',
            'fulfillment_status' => 'required|in:fulfilled,unfulfilled',
            'fulfillment_date' => "nullable|date"
        ]);

        $payment_change = false;
        $fulfilment_change = false;

        // Get Order
        $o = Order::find($id);

        // See what fields have been changed
        if($o->payment_status != $request->input('payment_status')) {
            $payment_change = true;
        }
        if($o->fulfillment_status != $request->input('fulfillment_status')) {
            $fulfilment_change = true;
        }

        // Update Order
        $o->payment_status = $request->input('payment_status');
        $o->fulfillment_status = $request->input('fulfillment_status');
        $o->fulfillment_date = $request->input('fulfillment_date');
        $o->save();

        // Create events for the order timeline
        $timestamp = date("h:i:a");

        if ($payment_change == true && $fulfilment_change == true) {
            $str = 'Payment and fulfillment';
        }
        elseif($payment_change == true) {
            $str = 'Payment';
        }
        elseif ($fulfilment_change == true) {
            $str = 'Fulfillment';
        }

        if($payment_change == true || $fulfilment_change == true) {
            $event = new Event();
            $event->name = $str .' status was updated on ' . date("d M Y") . ' at ' . $timestamp . '.';
            $event->order_id = $o->id;
            $event->save();
        }

        $request->session()->flash('alert-success', 'Order was sucessfully updated!');
        return redirect()->route('orders.index');
    }

    /**
     *  We prevent order from being deleted, so empty
     */
    public function destroy($id)
    {
        //
    }

    /**
     *  Creates shipment
     */
    public function saveShipment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'tracking_no' => 'required|max:300',
            'link' => 'required|max:300',
            'shipment_date' => 'required|date',
        ]);

        $shipment = new Shipment();
        $shipment->order_id = $request->input('order_id');
        $shipment->tracking_no = $request->input('tracking_no');
        $shipment->link = $request->input('link');
        $shipment->shipment_date = $request->input('shipment_date');
        $shipment->save();

        // Create events for the order timeline
        $event = new Event();
        $event->name = 'A new shipment was created on ' . date("d M Y") . ' at ' . date("h:i:a") . '.';
        $event->order_id = $shipment->order_id;
        $event->save();

        $request->session()->flash('alert-success', 'Shipment #' . $shipment->id . ' was created successfully!');
        return redirect()->route('orders.index');
    }
}
