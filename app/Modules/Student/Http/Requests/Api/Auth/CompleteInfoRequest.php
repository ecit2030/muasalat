<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompleteInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            "date_of_birth"    => "required|date|before:today",
            "ussid_number"     => "required|numeric|unique:users,ussid_number,".auth()->id() ?? NULL.",id",
            "ussid"            => "required|image|mimes:png,jpeg,gif|max:5000",
            "avatar"           => "nullable|image|mimes:png,jpeg,gif|max:5000",
            "driver_license"   => "required|image|mimes:png,jpeg,gif|max:5000",
//            "driver_license_number"  => "required|string|max:25|unique:users,driver_license_number,".auth()->id() ?? NULL.",id",
//            "driver_license_end_date"  => "required|date|after:today",
            "bank_name"        => "required|string|max:100",
            "bank_personal_id" => "required|numeric|unique:users,bank_personal_id,".auth()->id() ?? NULL.",id",
            "iban"             => "required|string|unique:users,iban,".auth()->id() ?? NULL.",id",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function messages()
    {
        return [
            'date_of_birth.required' => __('date of birth is required'),
            'date_of_birth.date' => __('date of birth must be type date'),

            'ussid_number.required' => __('ussid number is required'),
            'ussid_number.numeric' => __('ussid number must be number'),

            'bank_personal_id.required' => __('bank personal id number is required'),
            'bank_personal_id.numeric' => __('bank personal id number must be number'),

            'iban.required' => __('iban number is required'),
            'iban.numeric' => __('iban number must be number'),

            'bank_name.required' => __('bank name is required'),
            'bank_name.string' => __('bank name must be string'),

            'ussid.required' => __('ussid is required'),
            'ussid.image' => __('ussid must be type image'),

            'avatar.required' => __('avatar is required'),
            'avatar.image' => __('avatar must be type image'),

            'driver_license.required' => __('driver license is required'),
            'driver_license.image' => __('driver license must be type image'),


        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError(__('validation.error_validation'), $validator->errors()));
    }
}
