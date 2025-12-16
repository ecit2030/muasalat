<?php

namespace App\Http\Requests\Dashboard\ContactUs;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class ContactUsRequest extends FormRequest
{
    use ValidationRequest;


    public function rules()
    {
        return [
            'name'      => 'required|string',
            'email'     => 'required|email',
            'message'   => 'required|string',
        ];
    }
}
