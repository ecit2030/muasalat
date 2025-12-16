<?php

namespace App\Http\Requests\Api\Screen\Sidebar\ContactUs;

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
            'phone'     => 'nullable|string|max:10|min:10|starts_with:05',
            'email'     => 'required|email',
            'message'   => 'required|string',
        ];
    }
}
