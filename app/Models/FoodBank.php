<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'investment_amount',
        'saved_by',
        'voucher_code',
        'proof_upload_url',
        'verified_by',
        'verified_on'
    ];
}
