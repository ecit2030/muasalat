<?php

namespace App\Http\Requests\Dashboard\Captain;

use App\Models\User;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateCaptainRequestRequest extends FormRequest
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
            'vehicle_year_id' => 'required|exists:vehicle_years,id',
            'avatar' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'vehicle' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'vehicle_number' => 'required|numeric|unique:user_vehicles,vehicle_number',
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
