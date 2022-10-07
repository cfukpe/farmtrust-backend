<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_name',
        'account_number',
        'bank_name',
        'bank_code',
        'is_default',
    ];
}
