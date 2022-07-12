<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;

use App\Models\Company;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Events\CompanyCreated;
use App\Traits\StoreImageTrait;
use App\Interfaces\CompanyRepositoryInterface;
use Auth;

class CompanyController extends Controller
{
    use StoreImageTrait;

    private $repository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->middleware('auth');
        $this->repository = $companyRepository;
    }

    public function index()
    {
        $companies = $this->repository->getAll();
        return view('companies')->with('companies', $companies);
    }

    public function create()
    {
        return view('createcompany');
    }

    public function store(CreateCompanyRequest $request)
    {
        $request->validated();

        $user = Auth::user();
        $path = $this->checkValidityAndStoreImage($request, 'company-logo');
        $companyId = $this->repository->store($request, $user->id, $path)->id;

        CompanyCreated::dispatch($user->email, $companyId);

        return redirect()->route('companies.index');
    }

    public function show($id)
    {
        $company = $this->repository->getOne($id);
        return view('viewcompany')->with('company', $company);
    }

    public function edit(Company $company)
    {
        Gate::authorize('editCompany', $company);
        return view('editcompany')->with('company', $company);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $request->validated();

        if($request->hasFile('edit-company-logo')){
            $path = $this->checkValidityAndStoreImage($request, 'edit-company-logo');
        } else {
            $path = '';
        }

        $company = $this->repository->update($request, $company, $path);

        return redirect()->route('companies.index');
    }

    public function destroy(Company $company)
    {
        Gate::authorize('deleteCompany', $company);
        $this->repository->delete($company->id);

        return redirect()->route('companies.index');
    }
}
