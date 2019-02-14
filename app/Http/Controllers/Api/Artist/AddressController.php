<?php

namespace App\Http\Controllers\Api\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Address;
use App\User;
use Validator;

class AddressController extends Controller
{

    /**
     * Gets Addresses For User
     */
    public function getAddresses($user_id)
    {

      $user = User::find($user_id);

      if(!$user) {
        $json = [
            'success' => false,
            'error' => 'No user found'
        ];
        return response()->json($json, 400);
      }


        $addresses = $user->addresses;

        return response()->json($addresses, 200);
    }
}
