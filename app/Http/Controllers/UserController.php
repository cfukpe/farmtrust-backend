<?php

namespace App\Http\Controllers;

use App\Models\CorporativeMember;
use App\Models\Farm;
use App\Models\FoodBank;
use App\Models\Investment;
use App\Models\Saving;
use App\Models\User;
use App\Models\Withdrawal;
use App\Utilities\AppHelpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    public function subscribeToFarmTrust(Request $request)
    {
        $this->validate($request, [
            'transactionId' => 'string|required',
        ]);


        $http = new Client();
        $res = $http->get("https://api.paystack.co/transaction/verify/" . $request->transactionId, [
            "headers" => [
                "Authorization" => "Bearer " . config('paystack.secretKey'),
            ]
        ]);

        try {
            $response = json_decode($res->getBody(), 1);
            if (
                $response['data']['status']
                // && $response['data']['amount'] === $expectedAmount
                // && $response['data']['currency'] === $expectedCurrency
            ) {

                $user = User::find(auth()->id());
                $user->update([
                    'is_trust_member' => true
                ]);

                return AppHelpers::httpResponse(
                    User::with([
                        'farm',
                    ])->where('id', auth()->id())->first(),
                    "Your subscription to Farm Trust was successful"
                );
                // Success! Confirm the customer's payment
            } else {
                return AppHelpers::httpResponse(null, "Your subscription failed. Please try again", 400);
                // Inform the customer their payment was unsuccessful
            }
        } catch (\Exception $ex) {
            // \Log::error($ex);
            return AppHelpers::httpResponse(null, "Could not verify transaction", 400);
        }
    }

    public function farmSetup(Request $request)
    {
        $this->validate($request, [
            'farmName' => 'string|required',
            'farmAddress' => 'string|required',
            'farmCategory' => 'numeric|required',
            'state' => 'required|string',
            'isCorporative' => 'required|boolean'
        ]);

        // if (auth()->user()->farm) {
        //     throw new \Exception("You have already setup your farm.", 400);
        // }

        // $image = file_get_contents($request->avatarUrl['preview']);

        // $file_name = auth()->id() . strval(rand(1000000, 8000000)) . '.' . 'png';

        // $file = File::put(public_path("farm_insurance/" . $file_name, $image));
        // \Log::info($file);
        try {
            DB::beginTransaction();
            $farm = Farm::create([
                'farm_name' => $request->farmName,
                'farm_location' => $request->farmAddress,
                'investment_package_id' => $request->farmCategory,
                'farm_state' => $request->state,
                'is_corporative' => $request->isCorporative,
                'user_id' => auth()->id(),
            ]);

            if ($request->isCorporative && sizeof($request->corporativeMembers) < 2) {
                throw new HttpException(400, "You must provide at least two corporative members");
            }

            if ($request->isCorporative) {
                foreach ($request->corporativeMembers as $member) {
                    $corporativeMember = CorporativeMember::create([
                        'farm_id' => $farm->id,
                        'member_name' => $member['memberName'],
                        'member_bvn' => $member['bvn'],
                        'member_farm_name' => $member['farmName'],
                        'member_farm_location' => $member['farmLocation'],
                    ]);
                }
            }

            Db::commit();
            return AppHelpers::httpResponse($farm);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getUserHomeAnalytics(Request $request)
    {
        $total_savings = Saving::where('user_id', auth()->id())->sum('amount');
        $total_foodbank = FoodBank::where('user_id', auth()->id())->sum('investment_amount');
        $total_withdrawals = Withdrawal::where('user_id', auth()->id())->sum('withdrawal_amount');
        $recent_savings = Saving::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get()->take(5);
        $recent_investments = Investment::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get()->take(5);

        return AppHelpers::httpResponse([
            'total_savings' => $total_savings,
            'total_foodbank' => $total_foodbank,
            'total_withdrawals' => $total_withdrawals,
            'recent_savings' => $recent_savings,
            'recent_investments' => $recent_investments,
        ]);
    }
}
