<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utilities\AppHelpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;

class CardController extends Controller
{
    //
    public function setCard(Request $request)
    {
        $this->validate($request, [
            'transactionId' => 'string|required'
        ]);

        // $http = new Client();
        // $res = $http->get("https://api.paystack.co/transaction/verify/" . $request->transactionId, [
        //     "headers" => [
        //         "Authorization" => "Bearer " . config('paystack.secretKey'),
        //     ]
        // ]);

        try {
            // $response = json_decode($res->getBody(), 1);
            // if (
            //     // $response['data']['status']
            //     // && $response['data']['amount'] === $expectedAmount
            //     // && $response['data']['currency'] === $expectedCurrency
            // ) {
            \Log::info(auth()->user());
            $user = User::find($request->user_id);
            $user->update([
                'savings_plan' => $request->savings_plan
            ]);

            return AppHelpers::httpResponse(null, "Card Verifed");
            // Success! Confirm the customer's payment
            // } else {
            //     return AppHelpers::httpResponse(null, "Could not verify card payment", 400);
            //     // Inform the customer their payment was unsuccessful
            // }
        } catch (\Exception $ex) {
            \Log::error($ex);
            return AppHelpers::httpResponse(null, "Could not verify transaction", 400);
        }
    }
}
