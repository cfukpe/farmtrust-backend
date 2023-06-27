<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\FileUpload;
use App\Models\InvestmentPackageCategory;
use App\Services\InvestmentPackageCategoryService;
use App\Http\Requests\InvestmentPackageCategoryRequest;
use App\Http\Resources\InvestmentPackageCategoryResource;
use App\Http\Requests\UpdateInvestmentPackageCategoryRequest;

class InvestmentPackageCategoryController extends Controller
{

    protected $investmentPackageCategoryService;

    public function __construct(InvestmentPackageCategoryService $investmentPackageCategoryService)
    {
        $this->investmentPackageCategoryService = $investmentPackageCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investmentPackageCategory = $this->investmentPackageCategoryService->index();

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

        $investmentPackageCategory = $this->investmentPackageCategoryService->store($request->all());

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
        $investmentPackageCategory = $this->investmentPackageCategoryService->show($id);

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
        $investmentPackageCategory = $this->investmentPackageCategoryService->update($request->all(), $id);

        $investmentPackageCategoryResource =  new InvestmentPackageCategoryResource($investmentPackageCategory);

        return $this->successResponse("Investment category updated successfully", $investmentPackageCategoryResource);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->investmentPackageCategoryService->destroy($id);

        return $this->successResponse("Investment category deleted successfully");
    }
}
