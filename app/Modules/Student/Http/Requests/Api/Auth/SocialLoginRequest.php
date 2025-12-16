<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SocialLoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'provider'    => 'required|string|in:facebook,google,apple',
            'provider_id' => 'required|string',
            'email'       => 'required|email:filter',
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'birth_date'  => 'nullable|date',
            'gender'      => 'nullable|in:1,2',
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


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException( sendError(__('validation.error_validation'), $validator->errors() ));
    }

}
