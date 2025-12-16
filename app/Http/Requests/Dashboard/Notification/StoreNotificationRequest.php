<?php

namespace App\Http\Requests\Dashboard\Notification;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreNotificationRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            "title" => "required|string|max:250",
            "message" => "required|string|max:250",
            "receiver_types" => "required|array|max:6",
            "receiver_types.*" => "required",
            "receivers" => "nullable|array|max:50",
            "receivers.*" => "required",
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

    public function attributes()
    {
        return [
            'title' => __('Title'),
            'message' => __('Message'),
            'receiver_types' => __('Receiver Trpes'),
            'receiver_types.*' => __('Receiver Trpe'),
            'receivers' => __('Receivers'),
            'receivers.*' => __('Receiver'),
        ];
    }
}
