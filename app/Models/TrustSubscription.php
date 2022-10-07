<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_amount',
        'status',
        'expiry_date',
    ];
}
