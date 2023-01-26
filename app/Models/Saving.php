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
        'amount',
        'proof_upload_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'saver_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'verified_by', 'id');
    }
}
