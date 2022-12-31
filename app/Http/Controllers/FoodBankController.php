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
            // 'trxref' => 'required',
            'amount' => 'required|numeric',
            'file' => 'required'
        ]);

        try {
            // $response = AppHelpers::verifyPayment($request->trxref);

            // if (!$response['data']['status']) {
            //     return AppHelpers::httpResponse(null, "Could not verify the payment", 400);
            // }

            $file = $request->file('file');

            $file_extension = $file->getClientOriginalExtension();
            $name = auth()->id() . strval(time()) . rand(1000, 9999) . '.' . $file_extension;

            $hostname = request()->server('SERVER_ADDR');

            $dir = '/img/savings/';

            $file->storeAs($dir, $name, 'public');

            $foodbank = FoodBank::create([
                'investment_amount' => $request->amount, //Paystack works in Kobo
                // 'voucher_code' => $request->voucher_code,
                'user_id' => auth()->id(),
                'proof_upload_url' => '/storage' . $dir . $name,
            ]);

            return AppHelpers::httpResponse($foodbank);
        } catch (\Exception $ex) {
            \Log::info($ex);
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
            'total' => FoodBank::where(['user_id' => $user_id, 'status' => AppConstants::$VERIFIED])->sum('investment_amount'),
            'withdrawals' => Withdrawal::where(['user_id' => $user_id, 'status' => AppConstants::$APPROVED])->sum('withdrawal_amount'),
        ]);
    }
}
