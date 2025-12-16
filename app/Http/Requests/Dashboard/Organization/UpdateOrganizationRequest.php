<?php

namespace App\Http\Requests\Dashboard\Organization;

use App\Models\User;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateOrganizationRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        $user = User::find(request("organization"));
        $vehicle = $user?->vehicle ;

        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable',
            'password_confirmation' => 'exclude_without:password|required',
            'phone' => 'string|max:10|min:10|starts_with:05|unique:users,phone,'.$user->id,
            'is_active' => 'nullable',

            'organization_name' => 'required|string|max:100|unique:users,organization_name,'.$user->id,
            'organization_commercial_number' => 'required|string|max:100|unique:users,organization_commercial_number,'.$user->id,

            'logo' => 'nullable|image|mimes:png,jpeg,gif|max:5000',

            'avatar' => 'nullable|image|mimes:png,jpeg,gif|max:5000',

            'roles' => 'nullable|array',

            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',

            "bank_name" => "required|string|max:100" ,
            "bank_personal_id" => "required|numeric|unique:users,bank_personal_id,".$user?->id ,
            "iban" => "required|string|unique:users,iban,".$user?->id ,
        ];

        if ($this->isMethod('PUT')) {
            $rules['password'] = ['nullable', 'confirmed'];
        }

        return $rules;
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
