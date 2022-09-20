<?php

namespace App\Http\Controllers;

use App\Utilities\AppHelpers;
use Illuminate\Http\Request;
use \Flutterwave\Rave;

class CardController extends Controller
{
    //
    public function setCard(Request $request)
    {
        $this->validate($request, [
            'transactionId' => 'string|required'
        ]);

        $flw = new Rave(getenv('FLW_SECRET_KEY'));
        $transactions = new \Flutterwave\Transactions();
        $response = $transactions->verifyTransaction(['id' => $request->transactionId]);

        if (
            $response['data']['status'] === "successful"
            // && $response['data']['amount'] === $expectedAmount
            // && $response['data']['currency'] === $expectedCurrency
        ) {
            return AppHelpers::httpResponse(null, "Card Verifed");
            // Success! Confirm the customer's payment
        } else {
            return AppHelpers::httpResponse(null, "Could not verify card payment", 400);
            // Inform the customer their payment was unsuccessful
        }
    }
}
