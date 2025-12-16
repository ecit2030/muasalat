<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use App\Rules\SaPhoneRule;
use Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePhoneRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'password' => 'required|string',
            'phone' => 'required|string|max:10|min:10|starts_with:05|unique:users,phone,'.auth()->id(),
        ];
    }



    // public function withValidator(Validator $validator)
    // {
    //     $validator->after(function ($validator) {

    //         $auth = Hash::check($this->password , auth()->user->password);

            // if(!$auth){
            //     $validator->errors()->add('password', __("wrong password"));
            //     throw new HttpResponseException( sendError(__('validation.error_validation'), $validator->errors() ));
            // }
    //     });
    // }

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
            'password.required' => __('password is required'),
            'phone.required' => __('phone is required'),
            'phone.unique' => __('This phone number is used by other user'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException( sendError(__('validation.error_validation'), $validator->errors() ));
    }


}
