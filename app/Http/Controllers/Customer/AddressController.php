<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\ShippingMethod;
use App\Event;
use Validator;
use App\Address;
use App\Product;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('role:customer');
     }
    public function index()
    {
        $addresses = Address::all();

        return view('customer.addresses.index')->with([
            'addresses' => $addresses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('customer.addresses.create')->with([
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
        $request->validate([
            'address' => 'required|string|max:100',
            'user_id' => 'required|exists:users,id',
            'address-type' => 'required|string'
        ]);

        $address = new Address();
        $address->line1 = $request->input('address');
        $address->user_id = $request->input('user_id');
        $addressType = $request->input('address-type');

        if($addressType == 'shipping'){
          $address->shipping = 1;
        }
        else if($addressType == 'billing'){
          $address->billing = 1;
        }

        $address->save();

        return redirect()->route('addresses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::findOrFail($id);

        return view('customer.addresses.edit')->with([
            'address' => $address
        ]);
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
        $request->validate([
            'address' => 'required|string|max:100',
            'user_id' => 'required|exists:users,id',
            'address-type' => 'required|string'
        ]);

        $address = Address::find($id);
        $address->line1 = $request->input('address');
        $address->user_id = $request->input('user_id');
        $addressType = $request->input('address-type');

        if($addressType == 'shipping'){
          $address->shipping = 1;
          $address->billing = 0;
        }
        else if($addressType == 'billing'){
          $address->billing = 1;
          $address->shipping = 0;
        }

        $address->save();

        return redirect()->route('addresses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();
        return redirect()->route('addresses.index');
    }
}
