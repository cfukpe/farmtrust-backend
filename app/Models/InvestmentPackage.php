<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'investment_category_id',
        'package_name',
        'package_description',
        'package_image_url',
        'unit_price',
        'duration',
        'return_rate',
        'package_available_units',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];


    public function investmentCategory()
    {
        return $this->belongsTo(InvestmentPackageCategory::class);
    }
}
