<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use App\Rules\SaPhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => request()->get('role') == 'user' ? 'nullable|string|max:255' : 'nullable|string|max:255',
            'username' => request()->get('role') == 'user' ? 'required|string|min:6|max:50|unique:users,username' : 'nullable|string|min:6|max:50|unique:users,username',
            'full_name' => 'nullable|string|min:3|max:100',
            'email' => 'sometimes|email:filter|unique:users,email',
            'password' => [
                'required', Password::min(8)
                , 'confirmed',
            ],
            "role" => "required|in:user,captain",
            'avatar' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'is_active' => 'nullable',
            'phone' => 'required|string|max:10|min:10|starts_with:05|unique:users,phone',

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
            'name.required' => __('Name is required'),
            'name.string' => __('Name must be a string'),
            'email.required' => __('Email is required'),
            'email.email' => __('Invalid email'),
            'email.unique' => __('This mail is used before'),
            'password.required' => __('Password is required'),
            'validation.password.min' => __('Password must be at least 8 characters'),
            'validation.password.letters' => __('Password must contain at least one letter'),
            'validation.password.mixed' => __('Password must contain at least one uppercase and one lowercase letter'),
            'validation.password.numbers' => __('Password must contain at least one number'),
            'password.confirmation' => __('Password and password confirmation do not match'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError(__('validation.error_validation'), $validator->errors()));
    }


}
