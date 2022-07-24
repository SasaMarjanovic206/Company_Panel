<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SearchCompaniesRequest extends FormRequest
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
    public function rules(Request $request)
    {
        dd($request->term);
        return [
            'search-term' => 'required|regex:/^[ A-Za-z0-9ČčĆćŽžŠšĐđ,:@._+\-\x28\x29\"\s\/]*$/'
        ];
    }
}
