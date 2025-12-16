<?php

namespace App\Http\Requests\Dashboard\Organization;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateOrganizationRequestRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        dd(request()->all());

        $id =1;
        return  [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email,' .$id,
            'password' => ['required', 'confirmed'],
            'phone' => 'string|max:10|min:10|starts_with:05|unique:users,phone,' .$id,
            'is_active' => 'nullable',

            'organization_name' => 'required|string|max:100|unique:users,organization_name,' .$id,
            'organization_commercial_number' => 'required|string|max:100|unique:users,organization_commercial_number,' .$id,
            'logo' => 'nullable|image|mimes:png,jpeg,gif|max:5000',

            'avatar' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'roles' => 'nullable|array',

            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',

            "bank_name" => "required|string|max:100" ,
            "bank_personal_id" => "required|numeric|unique:users,bank_personal_id," .$id ,
            "iban" => "required|string|unique:users,iban," .$id ,
        ];
    }


    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {

            if ($validator->errors()) {
                return redirect()->back()->withErrors($validator);
            }
        });
    }


}
