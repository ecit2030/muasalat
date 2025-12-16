<?php

namespace App\Http\Requests\Dashboard\Driver;

use App\Models\User;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreDriverRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed'],
            'phone' => 'required|string|max:10|min:10|starts_with:05|unique:users,phone',
            'is_active' => 'nullable',

            'organization_id' => 'nullable|exists:users,id',
            "driver_license_end_date"  => "required|date|after:today" ,

            "date_of_birth" => "required|date|before:today",
            'ussid_number' => 'required|numeric|unique:users,ussid_number',

            'avatar' => 'required|image|mimes:png,jpeg,gif|max:5000',
            'ussid' => 'required|image|mimes:png,jpeg,gif|max:5000',
            "driver_license" => "required|image|mimes:png,jpeg,gif|max:5000",
            "driver_license_number" => "required|numeric|unique:users,driver_license_number",
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

    public function messages(){
        return [
            'driver_license_end_date.after' => __('The driver license end date must be a date after today.'),
        ];
    }
}