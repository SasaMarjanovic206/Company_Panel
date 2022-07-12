<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Company;

use Auth;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->id === $this->route('company')->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'edit-company-name' => 'required|min:3',
            'edit-company-email' => 'email|nullable|unique:companies,email,'.Auth::user()->id.',user_id',
            'edit-company-website' => 'min:5|nullable',
            'edit-company-logo' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
        ];
    }
}
