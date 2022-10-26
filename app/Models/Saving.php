<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_code',
        'user_id',
        'saver_id',
        'amount'
    ];
}
