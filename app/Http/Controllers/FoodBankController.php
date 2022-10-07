<?php

namespace App\Http\Controllers;

use App\Models\FoodBank;
use App\Models\Withdrawal;
use App\Utilities\AppConstants;
use App\Utilities\AppHelpers;
use Illuminate\Http\Request;

class FoodBankController extends Controller
{
    //

    public function addMoney(Request $request)
    {
        $this->validate($request, [
            'trxref' => 'required'
        ]);

        try {
            $response = AppHelpers::verifyPayment($request->trxref);

            \Log::info($response);
            if (!$response['data']['status']) {
                return AppHelpers::httpResponse(null, "Could not verify the payment", 400);
            }

            $food_bank = FoodBank::create([
                'investment_amount' => $response['data']['amount'] / 100, //Paystack works in Kobo
                'user_id' => auth()->id(),
            ]);

            return AppHelpers::httpResponse($food_bank);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getUserFoodBankSavings($user_id)
    {
        $savings = FoodBank::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return AppHelpers::httpResponse($savings);
    }

    public function getUserFoodBankSavingsAnalytics($user_id)
    {
        return AppHelpers::httpResponse([
            'total' => FoodBank::where('user_id', $user_id)->sum('investment_amount'),
            'withdrawals' => Withdrawal::where(['user_id' => $user_id, 'status' => AppConstants::$APPROVED])->sum('withdrawal_amount'),
        ]);
    }
}
