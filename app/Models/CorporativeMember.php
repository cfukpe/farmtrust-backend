<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporativeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'member_name',
        'member_farm_name',
        'member_farm_location',
        'member_bvn'
    ];
}
