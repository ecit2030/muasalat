<?php

namespace App\Http\Requests\Dashboard\Setting;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class SocialSettingRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [

            'social.phone' => 'phone:auto',
            'social.email1' => 'email:dns',
            'social.email2' => 'email:dns',
            'social.facebook' => 'url',
            'social.twitter' => 'url',
            'social.instagram' => 'url',
            'social.youtube' => 'url',
            'social.linkedin' => 'url',
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

    public function messagesAction(): array
    {
        return [
            'social.phone.phone' => t_('phone number must be valid phone number'),
        ];
    }
}
