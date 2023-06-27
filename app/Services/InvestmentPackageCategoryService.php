<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\InvestmentPackageCategory;
use App\Utilities\FileUpload;
use App\Http\Resources\InvestmentPackageCategoryResource;

class InvestmentPackageCategoryService
{
    public function index()
    {
        $investmentPackageCategory = InvestmentPackageCategory::query()
            ->with('investmentPackages')
            ->paginate(10);

        $investmentPackageCategoryResource = InvestmentPackageCategoryResource::collection($investmentPackageCategory);
        $investmentPackageCategory->data = $investmentPackageCategoryResource;

        return $investmentPackageCategory;
    }

    public function store($requestData)
    {
        $imagePath = null;
        if (isset($requestData['image'])) {
            $imagePath = (new FileUpload())->uploadFile($requestData['image'], 'categories');
        }

        $investmentPackageCategory = InvestmentPackageCategory::create([
            'investment_category_name' => $requestData['investment_category_name'],
            'investment_category_description' => $requestData['investment_category_description'],
            'investment_category_cover_image' => $imagePath,
            'status' => $requestData['status'],
        ]);

        return $investmentPackageCategory;
    }

    public function show($id)
    {
        $investmentPackageCategory = InvestmentPackageCategory::find($id);

        if (!$investmentPackageCategory) {
            throw new NotFoundException("Investment package category not found");
        }

        return $investmentPackageCategory;
    }

    public function update($requestData, $id)
    {
        $investmentPackageCategory = InvestmentPackageCategory::find($id);

        if (!$investmentPackageCategory) {
            throw new NotFoundException("Investment category not found");
        }

        $fileUpload = null;

        if (isset($requestData['image'])) {
            $fileUpload = (new FileUpload())->uploadFile($requestData['image'], 'categories');
        }

        $data = [
            'investment_category_name' => $requestData['investment_category_name'],
            'investment_category_description' => $requestData['investment_category_description'],
            'status' => $requestData['status'],
        ];

        if (!is_null($fileUpload)) {
            $data['investment_category_cover_image'] = $fileUpload;
        }

        $investmentPackageCategory->update($data);

        return $investmentPackageCategory;
    }

    public function destroy($id)
    {
        $investmentPackageCategory = InvestmentPackageCategory::find($id);

        if (!$investmentPackageCategory) {
            throw new NotFoundException("Investment category not found");
        }

        $investmentPackageCategory->delete();

        return true;
    }
}
