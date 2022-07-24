<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Company;

class SearchCompaniesController extends Controller
{
    public function search(Request $request)
    {
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

        $companies = Company::search($request->term)->get()->load('user');
        
        return response()->json($companies);
    }
}
