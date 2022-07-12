<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Auth;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->id === $this->route('employee')->company->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        $companyid = $request->input('companyid');
        return [
            'edit-first-name' => 'required|min:3',
            'edit-last-name' => 'required|min:3',
            'edit-employee-email' => 'email|nullable|unique:companies,email,'.$companyid.',id', 
            'edit-phone' => 'nullable|regex:/^[ 0-9\-\x28\x29\s\+\/]*$/',
            // 'company_id' => 'required|exists:companies,id'
        ];
    }
}
