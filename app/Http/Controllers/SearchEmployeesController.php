<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

use App\Models\Employee;

class SearchEmployeesController extends Controller
{
    public function search(Request $request)
    {
        Gate::authorize('searchEmployee', $request->companyid);
        
        $validator = Validator::make(
            [
                'Termin za pretragu' => $request->term
            ],
            [
                'Termin za pretragu' => 'required|regex:/^[ A-Za-z0-9ČčĆćŽžŠšĐđ,:@._+\-\x28\x29\"\s\/]*$/'
            ]
        );
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $employees = Employee::search($request->term)->get()->load('company');
        
        return response()->json($employees);
    }
}
