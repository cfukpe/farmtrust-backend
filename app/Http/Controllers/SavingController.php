<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Utilities\AppConstants;
use App\Utilities\AppHelpers;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    //
    public function index()
    {
        $savings = Saving::with(['user'])->orderBy('created_at', 'desc')->get();
        return AppHelpers::httpResponse($savings);
    }


    public function getUserSavings($user_id)
    {
        $savings = Saving::where(['user_id' => $user_id])->get();

        return AppHelpers::httpResponse($savings);
    }

    public function agentAddMoney(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'file' => 'required'
        ]);

        try {

            $file = $request->file('file');

            $file_extension = $file->getClientOriginalExtension();
            $name = auth()->id() . strval(time()) . rand(1000, 9999) . '.' . $file_extension;

            $hostname = request()->server('SERVER_ADDR');

            $dir = '/img/savings/';

            $file->storeAs($dir, $name, 'public');

            $saving = Saving::create([
                'amount' => $request->amount,
                'voucher_code' => $request->voucher_code,
                'user_id' => $request->user_id,
                'proof_upload_url' => '/storage' . $dir . $name,
                'saver_id' => auth()->id(),
            ]);

            $saving = Saving::where('id', $saving->id)->with(['user', 'agent'])->first();

            return AppHelpers::httpResponse($saving);
        } catch (\Exception $ex) {
            throw $ex;
        }
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
            throw $ex;
        }
    }

    public function approveSaving($id)
    {
        $saving = Saving::findOrFail($id);

        $saving->status = AppConstants::$APPROVED;
        $saving->verified_by = auth()->id();
        $saving->verified_on = \Carbon\Carbon::now()->toDateTimeString();

        $saving->save();

        $updatedSaving = Saving::where('id', $id)->with(['user'])->first();

        return AppHelpers::httpResponse($updatedSaving);
    }


    public function getUserSavingsAnalytics($user_id)
    {
        return AppHelpers::httpResponse([
            'total' => Saving::where(['user_id' => $user_id,])->sum('amount'),
            'approved' => Saving::where(['user_id' => $user_id, 'status' => AppConstants::$APPROVED])->sum('amount'),
            'withdrawals' => 0,
        ]);
    }

    public function getAgentSavings($agent_id)
    {
        $savings = Saving::where(['saver_id' => $agent_id])->with(['user', 'agent'])->orderBy('created_at', 'desc')->get();
        return AppHelpers::httpResponse($savings);
    }
}
