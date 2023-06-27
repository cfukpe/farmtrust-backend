<?php

namespace App\Services;

use App\Utilities\FileUpload;
use App\Models\InvestmentPackage;
use App\Exceptions\NotFoundException;
use App\Http\Resources\InvestmentPackageResource;
use App\Http\Requests\CreateInvestmentPackageRequest;
use App\Http\Requests\UpdateInvestmentPackageRequest;

class InvestmentPackageService
{
    public function index()
    {
        $investmentPackage = InvestmentPackage::query()->paginate(10);

        $investmentPackageResource =  InvestmentPackageResource::collection($investmentPackage);
        $investmentPackage->data = $investmentPackageResource;

        return $investmentPackage;
    }

    public function store(CreateInvestmentPackageRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = (new FileUpload)->uploadFile($request->file('image'), 'products');
        }

        $investmentPackage = InvestmentPackage::create([
            'investment_category_id' => $request->investment_category_id,
            'package_name' => $request->package_name,
            'package_description' => $request->package_description,
            'package_image_url' => $imagePath ?? null,
            'unit_price' => $request->unit_price,
            'duration' => $request->duration,
            'return_rate' => $request->return_rate,
            'package_available_units' => $request->package_available_units,
            'status' => $request->status,
        ]);

        return $investmentPackage;
    }

    public function show($id)
    {
        $investmentPackage = InvestmentPackage::find($id);

        if (!$investmentPackage) {
            throw new NotFoundException("Investment category not found");
        }

        return $investmentPackage;
    }

    public function update(UpdateInvestmentPackageRequest $request, $id)
    {
        $investmentPackage = InvestmentPackage::find($id);

        if (!$investmentPackage) {
            throw new NotFoundException("Investment category not found");
        }

        $fileUpload = null;

        if (!is_null($request->image)) {
            $fileUpload = (new FileUpload())->uploadFile($request->image, 'products');
        }

        $data = [
            'investment_category_id' => $request->investment_category_id,
            'package_name' => $request->package_name,
            'package_description' => $request->package_description,
            'unit_price' => $request->unit_price,
            'duration' => $request->duration,
            'return_rate' => $request->return_rate,
            'package_available_units' => $request->package_available_units,
            'status' => $request->status,
        ];

        if (!is_null($fileUpload)) {
            $data['package_image_url'] = $fileUpload;
        }

        $investmentPackage->update($data);

        return $investmentPackage;
    }

    public function destroy($id)
    {
        $investmentPackage = InvestmentPackage::find($id);

        if (!$investmentPackage) {
            throw new NotFoundException("Investment category not found");
        }

        $investmentPackage->delete();

        return $investmentPackage;
    }
}
