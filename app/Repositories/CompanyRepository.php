<?php

namespace App\Repositories;

use App\Models\Company;
use App\Interfaces\CompanyRepositoryInterface;

use Auth;

class CompanyRepository implements CompanyRepositoryInterface {

    public function getAll()
    {
        return Company::orderBy('id', 'ASC')->paginate(10);
    }

    public function store($data, $userId, $path)
    {
        $company = new Company;
        $company->name = $data->input('company-name');
        $company->email = $data->input('company-email');
        $company->website = $data->input('company-website');
        $company->logo = $path;
        $company->user_id = $userId;
        $company->save();

        return $company;
    }
    
    public function getOne($id)
    {
        return Company::findOrFail($id); //
    }

    public function update($data, $company, $path)
    {
        $company->name = $data->input('edit-company-name');
        $company->email = $data->input('edit-company-email');
        $company->website = $data->input('edit-company-website');
        $company->logo = $path;
        $company->user_id = Auth::user()->id; //
        $company->save();

        return $company;
    }

    public function delete($id)
    {
        Company::findOrFail($id)->delete();
    }

}