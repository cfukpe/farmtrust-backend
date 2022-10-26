<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Utilities\AppHelpers;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    //
    public function getUserSavings($user_id)
    {
        \Log::info("I got here");
        \Log::info($user_id);
        $savings = Saving::where(['user_id' => $user_id])->get();

        return AppHelpers::httpResponse($savings);
    }

    public function addMoney(Request $request)
    {
        $this->validate($request, [
            'trxref' => 'required'
        ]);

        try {
            $response = AppHelpers::verifyPayment($request->trxref);

            if (!$response['data']['status']) {
                return AppHelpers::httpResponse(null, "Could not verify the payment", 400);
            }

            $saving = Saving::create([
                'amount' => $response['data']['amount'] / 100, //Paystack works in Kobo
                'voucher_code' => $request->voucher_code,
                'user_id' => auth()->id(),
            ]);

            \Log::info($saving);

            return AppHelpers::httpResponse($saving);
        } catch (\Exception $ex) {
            \Log::info($ex);
            throw $ex;
        }
    }


    public function getUserSavingsAnalytics($user_id)
    {
        return AppHelpers::httpResponse([
            'total' => Saving::where('user_id', $user_id)->sum('amount'),
            'withdrawals' => 0,
        ]);
    }
}
