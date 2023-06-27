<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\AppHelpers;
use App\Utilities\FileUpload;
use App\Models\InvestmentPackage;
use App\Services\InvestmentPackageService;
use App\Http\Resources\InvestmentPackageResource;
use App\Http\Requests\CreateInvestmentPackageRequest;
use App\Http\Requests\UpdateInvestmentPackageRequest;

class InvestmentPackageController extends Controller
{
    private $investmentPackageService;

    public function __construct(InvestmentPackageService $investmentPackageService)
    {
        $this->investmentPackageService = $investmentPackageService;
    }

    public function index()
    {
        $investmentPackage = $this->investmentPackageService->index();

        return $this->successResponse("Investment packages retrieve successfully", $investmentPackage);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvestmentPackageRequest $request)
    {

        $investmentPackage = $this->investmentPackageService->store($request);

        $investmentPackageResource =  new InvestmentPackageResource($investmentPackage);

        return $this->createdResponse("Investment package created successfully", $investmentPackageResource);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $investmentPackage = $this->investmentPackageService->show($id);

        $investmentPackageResource =  new InvestmentPackageResource($investmentPackage);

        return $this->successResponse("Investment package retreived successfully", $investmentPackageResource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvestmentPackageRequest $request, $id)
    {
        $investmentPackage = $this->investmentPackageService->update($request, $id);

        $investmentPackageResource =  new InvestmentPackageResource($investmentPackage);

        return $this->successResponse("Investment package updated successfully", $investmentPackageResource);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->investmentPackageService->destroy($id);

        return $this->successResponse("Investment package deleted successfully");
    }
}
