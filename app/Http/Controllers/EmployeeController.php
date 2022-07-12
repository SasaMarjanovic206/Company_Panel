<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Employee;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Interfaces\EmployeeRepositoryInterface;

use Auth;

class EmployeeController extends Controller
{
    private $repository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->middleware('auth');
        $this->repository = $employeeRepository;
    }

    public function createEmployee($id)
    {
        Gate::authorize('createEmployee', $id);
        return view('createemployee')->with('id', $id);
    }


    public function store(CreateEmployeeRequest $request)
    {
        $request->validated();
        $this->repository->store($request);

        return redirect()->route('companies.show', ['company' => $request->input('company-id')]);
    }


    public function edit(Employee $employee)
    {
        Gate::authorize('editEmployee', $employee);
        return view('editemployee')->with('employee', $employee);
    }


    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $request->validated();

        $this->repository->update($request, $employee);

        return redirect()->route('companies.show', ['company' => $request->input('companyid')]);
    }


    public function destroy(Employee $employee)
    {
        Gate::authorize('deleteEmployee', $employee);
        $companyid = $employee->company_id;
        $this->repository->delete($employee->id);

        return redirect()->route('companies.show', ['company' => $employee->company_id]);
    }
}
