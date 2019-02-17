<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Card;
use App\User;
use Validator;

class CardController extends Controller
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
     * Create Card For User
     */
    public function createCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_number' => 'digits:16',
            'card_holder_name' => 'required|string',
            'expiry' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            $json = [
                'success' => false,
                'error' => $validator->errors()
            ];
            return response()->json($json, 400);
        }

        // Instance Variables
        $card_number = $request->card_number;
        $card_holder_name = $request->card_holder_name;
        $expiry = $request->expiry;
        $user_id = $request->user_id;

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

        // Create Card
        $card = new Card();
        $card->number = $card_number;
        $card->name_on_card = $card_holder_name;
        $card->expiry = $expiry;
        $card->user_id = $user_id;
        $card->save();

        return response()->json($card, 200);
    }
}
