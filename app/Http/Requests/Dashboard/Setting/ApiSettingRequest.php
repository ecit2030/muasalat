<?php

namespace App\Http\Requests\Dashboard\Setting;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;

class ApiSettingRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'api_keys.google_api' => 'required',
        ];
    }
}
