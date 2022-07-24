<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('editCompany', function(User $user, Company $company){
            return $user->id === $company->user_id;
        });
        Gate::define('deleteCompany', function(User $user, Company $company){
            return $user->id === $company->user_id;
        });
        Gate::define('editEmployee', function(User $user, Employee $employee){
            return $user->id === $employee->company->user_id;
        });
        Gate::define('createEmployee', function(User $user, $id){
            $company = Company::find($id);
            return $user->id === $company->user_id;
        });
        Gate::define('deleteEmployee', function(User $user, Employee $employee){
            return $user->id === $employee->company->user_id;
        });
        Gate::define('searchEmployee', function(User $user, $companyid){
            $company = Company::find($companyid);
            return $user->id === $company->user_id;
        });
    }
}
