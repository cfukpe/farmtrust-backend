<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPackage;
use App\Utilities\AppHelpers;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = InvestmentPackage::all();
        return AppHelpers::httpResponse($products);
    }

    public function getSingleProduct($product_id)
    {
        $product = InvestmentPackage::where('id', $product_id)->orWhere('package_name', $product_id)->first();
        return AppHelpers::httpResponse($product);
    }
}
