<?php

namespace App\Http\Controllers;

use App\Console\Constants\CompanyResponseEnum;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\RatingCompanyResource;
use App\Http\Resources\TopCompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(protected readonly CompanyService $companyService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->companyService->companyList();

        return response([
            'data' => CompanyResource::collection($data),
            'message' => CompanyResponseEnum::COMPANY_LIST,
            'success' => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $storeRequest)
    {
        $data = $this->companyService->companyStore($storeRequest->validated());
        return response([
            'data' => CompanyResource::make($data),
            'message' => CompanyResponseEnum::COMPANY_CREATE,
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return response([
            'data' => CompanyResource::make($company),
            'message' => CompanyResponseEnum::COMPANY_SHOW,
            'success' => true,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, Company $company)
    {
        $data = $this->companyService->companyUpdate($updateRequest->validated(), $company);
        return response([
            'data' => CompanyResource::make($data),
            'message' => CompanyResponseEnum::COMPANY_UPDATED,
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $this->companyService->deleteCompany($company);

        return response([
            'message' => CompanyResponseEnum::COMPANY_DELETED,
            'success' => true,
        ]);
    }

    public function comments(Company $company)
    {

        return response([
            'data' => CompanyResource::make($company->load('comments')),
            'message' => CompanyResponseEnum::COMPANY_COMMENT,
            'success' => true,
        ]);
    }

    public function companyValuation(Company $company)
    {
        $data = $this->companyService->rating($company);

        return response([
            'data' => RatingCompanyResource::make($company),
            'average rating' => $data,
            'message' => CompanyResponseEnum::COMPANY_RATING,
            'success' => true,
        ]);
    }

    public function companyTop()
    {
        $data = $this->companyService->top();

        return response([
            'data' => TopCompanyResource::collection($data),
            'message' => CompanyResponseEnum::COMPANY_TOP,
            'success' => true,
        ]);
    }
}
