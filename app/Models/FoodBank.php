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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'verified_by', 'id');
    }
    public function agent()
    {
        return $this->belongsTo(User::class, 'saver_id', 'id');
    }
}
