<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_name',
        'farm_description',
        'user_id',
        'investment_package_id',
        'farm_location',
        'farm_state',
        'is_corporative',
        'status',
    ];
}
