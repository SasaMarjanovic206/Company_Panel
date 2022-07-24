<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

use Fadion\Fixerio\Exchange;
use Fadion\Fixerio\Currency;

use App\Models\Company;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Events\CompanyCreated;
use App\Traits\StoreImageTrait;
use App\Interfaces\CompanyRepositoryInterface;
use Auth;
use Config;

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
        $path = str_replace('public/', '', $path);

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

        $path = $this->checkValidityAndStoreImage($request, 'edit-company-logo');
        $path = str_replace('public/', '', $path);

        $company = $this->repository->update($request, $company, $path);

        return redirect()->route('companies.index');
    }

    public function destroy(Company $company)
    {
        Gate::authorize('deleteCompany', $company);
        $this->repository->delete($company->id);

        return redirect()->route('companies.index');
    }

    // public function converter(Request $request)
    // {
    //     $from = $request->input('currency-from');
    //     $to = $request->input('currency-to');
    //     $amount = $request->input('amount');
        
    //     // $url = "http://api.apilayer.com/fixer/latest?access_key=Zzf34Xc6RyWXEVRb2V98SiuYOGhKTwAU?base=EUR";
    //     // $uri = Config::get('app.fixerkey');
    //     // $key = Config::get('app.fixerurl');
    //     // // $url = $uri . "latest?access_key=" . $key . "&base=EUR&symbols=RSD,USD,GBP";
    //     // // dd($url);
    //     // $curl = curl_init($url);
    //     // curl_setopt($curl, CURLOPT_URL, $url);
    //     // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //     // $headers = array(
    //     //     "Accept: application/json",
    //     // );
    //     // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    //     // $resp = curl_exec($curl);
    //     // curl_close($curl);
    //     // echo $resp;
    //     // dd($resp);

    //     // $symbols = 'RSD,USD,GBP';
    //     // $base = 'EUR';

    //     // $curl = curl_init();

    //     // curl_setopt_array($curl, array(
    //     // CURLOPT_URL => "http://api.apilayer.com/fixer/latest?symbols=".$symbols."&base=".$base,
    //     // CURLOPT_HTTPHEADER => array(
    //     //     "Content-Type: text/plain",
    //     //     "apikey: Zzf34Xc6RyWXEVRb2V98SiuYOGhKTwAU"
    //     // ),
    //     // CURLOPT_RETURNTRANSFER => true,
    //     // CURLOPT_ENCODING => "",
    //     // CURLOPT_MAXREDIRS => 10,
    //     // CURLOPT_TIMEOUT => 0,
    //     // CURLOPT_FOLLOWLOCATION => true,
    //     // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     // CURLOPT_CUSTOMREQUEST => "GET"
    //     // ));

    //     // $response = curl_exec($curl);

    //     // curl_close($curl);
    //     // $result = json_decode($response);
    //     // // dd($result->rates->RSD); // 117.348866

    // }
}
