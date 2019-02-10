<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Address;
use App\User;
use Validator;

class AddressController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('role:customer');
    }

    /**
     * Create Address For User
     */
    public function createAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'line1' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'shipping' => 'required|integer|min:0|max:1',
            'billing' => 'required|integer|min:0|max:1'
        ]);

        if ($validator->fails()) {
            $json = [
                'success' => false,
                'error' => $validator->errors()
            ];
            return response()->json($json, 400);
        }

        // Instance Variables
        $line1 = $request->line1;
        $user_id = $request->user_id;
        $shipping = $request->shipping;
        $billing = $request->billing;

        // Get User and check exists
        $user = User::findOrFail($user_id);

        // Authenticate user ??
        if($user == null) {
            $json = [
                'success' => false,
                'error' => "User does not exists"
            ];
            return response()->json($json, 400);
        }

        // Create Address
        $address = new Address();
        $address->line1 = $line1;
        $address->billing = $billing;
        $address->shipping = $shipping;
        $address->user_id = $user->id;
        $address->save();
        
        return response()->json($address, 200);
    }
}
