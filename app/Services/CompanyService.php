<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    /** @throws \Exception */

    public function companyList()
    {
        return Company::all();
    }

    public function companyStore($validate)
    {
        $validate['logo'] = Storage::disk('public')->put('logos', $validate['logo']);
        $company = Company::query()->create($validate);

        return $company;
    }

    public function companyUpdate($validate, Company $company)
    {
        if (isset($validate['logo'])) {
            Storage::disk('public')->delete('logos', $company->logo);
            $validate["logo"] = Storage::disk('public')->put('logos', $validate['logo']);
        }

        $company->update($validate);

        return $company->refresh();
    }

    public function deleteCompany(Company $company)
    {
        $company->delete();

        Storage::disk('public')->delete('logos', $company->logo);

        return true;
    }

    public function rating(Company $company)
    {
        $company->load('comments');
        $data = (float)$company->comments()->avg('rating');
        return $data;
    }

    public function top()
    {
        $data = Company::withCount(['comments as rating' => function ($query) {
            $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        }])->orderByDesc('rating')
            ->limit(10)
            ->get();
        return $data;
    }
}
