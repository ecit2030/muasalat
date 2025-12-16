<?php

namespace App\Http\Requests\Dashboard\Setting;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class GeneralSettingRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'general.name' => 'array',
            'general.description' => 'array',
            'general.address' => 'array',
            'general.timeRange' => 'numeric',
            'general.captain_accept_reject_time' => 'numeric',
            'general.client_trip_payment_time_before_cancel' => 'numeric',
            'general.tax' => 'numeric',
            'general.copyright' => 'array',
            'general.phone' => 'phone:auto',
            'general.email' => 'email:dns',
            'general.website' => 'url',
            'general.author' => 'string',
            'general.appPercentage' => 'numeric',
            'general.searchRange' => 'numeric',
            'general.app_version_number' => 'string',
            'general.android_link' => 'string',
            'general.ios_link' => 'string',
            'general.timezone' => 'string',
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
            'general.phone.phone' => t_('phone number must be valid phone number'),
            'media.email_logo.dimensions' => t_('email logo must be max height 1000px and max width 1000px'),

        ];
    }
}
