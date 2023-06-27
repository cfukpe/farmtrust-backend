<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPackageCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function investmentPackages()
    {
        return $this->hasMany(InvestmentPackage::class, 'investment_category_id');
    }
}