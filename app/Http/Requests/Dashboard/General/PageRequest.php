<?php

namespace App\Http\Requests\Dashboard\General;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'title' => 'required|string',
            'body.*' => 'required|string'
        ];
    }

}
