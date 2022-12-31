<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Utilities\AppConstants;
use App\Utilities\AppHelpers;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    //
    public function getUserSavings($user_id)
    {
        \Log::info($user_id);
        $savings = Saving::where(['user_id' => $user_id])->get();

        return AppHelpers::httpResponse($savings);
    }

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

            $saving = Saving::create([
                'amount' => $request->amount, //Paystack works in Kobo
                'voucher_code' => $request->voucher_code,
                'user_id' => auth()->id(),
                'proof_upload_url' => '/storage' . $dir . $name,
            ]);

            return AppHelpers::httpResponse($saving);
        } catch (\Exception $ex) {
            \Log::info($ex);
            throw $ex;
        }
    }


    public function getUserSavingsAnalytics($user_id)
    {
        return AppHelpers::httpResponse([
            'total' => Saving::where(['user_id' => $user_id, 'status' => AppConstants::$VERIFIED])->sum('amount'),
            'withdrawals' => 0,
        ]);
    }
}
