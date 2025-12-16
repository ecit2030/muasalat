<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SendCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'  => 'required_if:type,phone|exists:users,phone',
            'email'  => 'required_if:type,email|email|exists:users,email',
            'type' => 'nullable|in:phone,email',
            'user_type' => 'required|in:client,captain'
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
            'phone.required' => __('phone is required'),
            'phone.phone' => __('Invalid phone'),
            'phone.exists' => __('This phone is not registered'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException( sendError(__('validation.error_validation'), $validator->errors() ));
    }

}
