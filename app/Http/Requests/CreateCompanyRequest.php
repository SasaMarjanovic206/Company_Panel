<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Auth;

class CreateCompanyRequest extends FormRequest
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
        $user = Auth::user();

        return [
            'company-name' => 'required|min:3',
            'company-email' => 'required|email|unique:companies,email',
            'company-website' => 'min:5|nullable',
            'company-logo' => 'file|mimes:jpeg,png,jpg,bmp|max:2048|nullable',
        ];
    }
}
