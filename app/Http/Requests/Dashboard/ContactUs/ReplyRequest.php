<?php

namespace App\Http\Requests\Dashboard\ContactUs;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class ReplyRequest extends FormRequest
{
    use ValidationRequest;


    public function rules()
    {
        return [
            'reply'   => 'required|string|max:190',
            'contact_us_id'   => 'required|exists:contact_us,id',
        ];
    }
}
