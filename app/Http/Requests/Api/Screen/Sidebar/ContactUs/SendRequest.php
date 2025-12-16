<?php

namespace App\Http\Requests\Api\Screen\Sidebar\ContactUs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SendRequest extends FormRequest
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

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        return $url->previous()."/#section-contact-us";
    }

    public function attributes()
    {
        return [
            'name'                  => __('Name'),
            'email'                 => __('Email'),
            'phone'                 => __('Phone'),
            'message'               => __('Message'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required|string|between:2,50',
            'email'                 => 'required|email:filter|max:255',
            'phone'                 => 'required|digits:12|regex:/^(9665)?([0-9]){2}([0-9]){6}$/',
            'message'               => 'required|string|between:2,2000',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError(__('validation.error_validation'), $validator->errors()));
    }

}
