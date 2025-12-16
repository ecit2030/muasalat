<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required'],
            'new_password' => [
                'required', Password::min(8)

                , 'confirmed',
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
            'old_password.required' => __('Current password is required'),
            'new_password.required' => __('New password is required'),
            'validation.new_password.min' => __('New password must be at least 8 characters'),
            'validation.new_password.letters' => __('New password must contain at least one letter'),
            'validation.new_password.mixed' => __('New password must contain at least one uppercase and one lowercase letter'),
            'validation.new_password.numbers' => __('New password must contain at least one number'),
            'new_password.confirmation' => __('New password and password confirmation do not match'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException( sendError(__('validation.error_validation'), $validator->errors() ));
    }

}
