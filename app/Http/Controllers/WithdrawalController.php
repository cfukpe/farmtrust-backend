<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Utilities\AppHelpers;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    //

    public function getUserWithdrawals($user_id)
    {
        $withdrawals = Withdrawal::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return AppHelpers::httpResponse($withdrawals);
    }
}
