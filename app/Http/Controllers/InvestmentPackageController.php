<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPackage;
use App\Utilities\AppHelpers;
use Illuminate\Http\Request;

class InvestmentPackageController extends Controller
{
    //
    public function index()
    {
        return AppHelpers::httpResponse(InvestmentPackage::all());
    }
}
