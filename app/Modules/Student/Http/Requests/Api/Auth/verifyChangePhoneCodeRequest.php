<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class verifyChangePhoneCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'  => 'required|exists:codes,phone',
            'code'   => 'required',
            'type'   => 'nullable',
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
            'code.required' => __('Code is required')
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException( sendError(__('validation.error_validation'), $validator->errors() ));
    }

}
