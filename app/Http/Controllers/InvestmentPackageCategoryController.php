<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\FileUpload;
use App\Models\InvestmentPackageCategory;
use App\Http\Requests\InvestmentPackageCategoryRequest;
use App\Http\Resources\InvestmentPackageCategoryResource;
use App\Http\Requests\UpdateInvestmentPackageCategoryRequest;

class InvestmentPackageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investmentPackageCategory = InvestmentPackageCategory::query()->paginate(10);

        $investmentPackageCategoryResource =  InvestmentPackageCategoryResource::collection($investmentPackageCategory);
        $investmentPackageCategory->data = $investmentPackageCategoryResource;

        return $this->successResponse("Investment categories retrieve successfully", $investmentPackageCategory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvestmentPackageCategoryRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = (new FileUpload)->uploadFile($request->file('image'), 'categories');
        }
        $investmentPackageCategory = InvestmentPackageCategory::create([
            'investment_category_name' => $request->investment_category_name,
            'investment_category_description' => $request->investment_category_description,
            'investment_category_cover_image' => $imagePath ?? null,
            'status' => $request->status,
        ]);

        $investmentPackageCategoryResource =  new InvestmentPackageCategoryResource($investmentPackageCategory);

        return $this->createdResponse("Investment category created successfully", $investmentPackageCategoryResource);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $investmentPackageCategory = InvestmentPackageCategory::find($id);

        if (!$investmentPackageCategory) {
            return $this->notFoundAlert("Investment package category not found");
        }

        $investmentPackageCategoryResource =  new InvestmentPackageCategoryResource($investmentPackageCategory);

        return $this->successResponse("Investment category retreived successfully", $investmentPackageCategoryResource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvestmentPackageCategoryRequest $request, $id)
    {
        $investmentPackageCategory = InvestmentPackageCategory::find($id);

        if (!$investmentPackageCategory) {
            return $this->notFoundAlert("Investment category not found");
        }

        if (!is_null($request->image)) {
            $fileUpload = (new FileUpload())->uploadFile($request->image, 'categories');
        }

        $investmentPackageCategory->update([
            'investment_category_name' => $request->investment_category_name,
            'investment_category_description' => $request->investment_category_description,
            'investment_category_cover_image' => $fileUpload ?? null,
            'status' => $request->status,
        ]);

        $investmentPackageCategoryResource =  new InvestmentPackageCategoryResource($investmentPackageCategory);

        return $this->successResponse("Investment category retrieved successfully", $investmentPackageCategoryResource);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $investmentPackageCategory = InvestmentPackageCategory::find($id);

        if (!$investmentPackageCategory) {
            return $this->notFoundAlert("Investment category not found");
        }

        $investmentPackageCategory->delete();

        return $this->successResponse("Investment category deleted successfully");
    }
}