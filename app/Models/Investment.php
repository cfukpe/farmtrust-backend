<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'investment_package_id',
        'investment_capital',
        'purchased_units',
        'expected_return_date',
        'return_rate',
        'status',
    ];
}
