<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface{

    public function getOne($id)
    {
        return Employee::findOrFail($id);
    }

    public function store($data)
    {
        $employee = new Employee;
        $employee->first_name = $data->input('first-name');
        $employee->last_name = $data->input('last-name');
        $employee->email = $data->input('employee-email');
        $employee->phone = $data->input('phone');
        $employee->company_id = $data->input('company-id');
        $employee->save();

        return $employee;
    }

    public function update($data, $employee)
    {
        $employee->first_name = $data->input('edit-first-name');
        $employee->last_name = $data->input('edit-last-name');
        $employee->email = $data->input('edit-employee-email');
        $employee->phone = $data->input('edit-phone');
        $employee->company_id = $data->input('companyid');
        $employee->save();

        return $employee;
    }

    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
    }

}