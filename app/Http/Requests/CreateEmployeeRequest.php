<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first-name' => 'required|min:3',
            'last-name' => 'required|min:3',
            'employee-email' => 'email|unique:employees,email|nullable',
            'phone' => 'nullable|regex:/^[ 0-9\-\x28\x29\s\+\/]*$/',
            'company-id' => 'required|exists:companies,id'
        ];
    }
}
