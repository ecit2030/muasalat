<?php

namespace App\Http\Requests\Dashboard\Driver;

use App\Models\User;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class UpdateDriverRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        $user = User::find(request("driver"));
        $vehicle = $user?->vehicle;
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email,' . $user?->id,
            'phone' => 'required|string|max:10|min:10|starts_with:05|unique:users,phone,' . $user?->id,
            'is_active' => 'nullable',
            'password' => ['nullable', 'confirmed', Password::defaults()],
            "driver_license_end_date" => "required|date|after:today",

            'organization_id' => 'nullable|exists:users,id',

            'ussid_number' => 'required|numeric|unique:users,ussid_number,' . $user?->id,
            "date_of_birth" => "required|date|before:today",

            'ussid' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'avatar' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'driver_license' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            "driver_license_number" => "required|numeric|unique:users,driver_license_number," . $user?->id,
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
