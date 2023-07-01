<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPackageCategory extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];


    public function investmentPackages()
    {
        return $this->hasMany(InvestmentPackage::class, 'investment_category_id');
    }
}