<?php

namespace App\Http\Requests\Dashboard\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class EmailSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'emails.host' => 'required',
            'emails.port' => 'required|numeric',
            'emails.username' => 'required',
            'emails.password' => 'required',
            'emails.encryption' => 'required',
            'emails.from_address' => 'required|email',
            'emails.from_name' => 'required',
            //            'emails.user_code.subject'=>'required',
            //            'emails.user_code.body'=>'required|regex:/{user_code}/|regex:/{user_name}/',
            //            'emails.tests_notification.subject'=>'required',
            //            'emails.tests_notification.body'=>'required|regex:/{user_code}/|regex:/{user_name}/',
            'emails.reset_password.subject' => 'required',
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


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user_code.subject' => 'User code mail subject',
            'user_code.body' => 'User code mail body',
            'tests_notification.subject' => 'Tests notification  mail subject',
            'tests_notification.body' => 'Tests notification mail body',
            'reset_password.subject' => 'Resetting password mail subject',
        ];
    }
}
