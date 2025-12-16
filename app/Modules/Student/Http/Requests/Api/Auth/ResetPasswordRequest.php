<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required_if:type,phone|exists:users,phone',
            'email' => 'required_if:type,email|email|exists:users,email',
            'type' => 'nullable|in:phone,email',
            'password' => ['required', Password::min(8), 'confirmed',
            ],
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
            'email.required' => __('Email is required'),
            'email.email' => __('Invalid email'),
            'email.exists' => __('This mail is not registered'),
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
