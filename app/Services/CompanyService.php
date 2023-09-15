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
}
