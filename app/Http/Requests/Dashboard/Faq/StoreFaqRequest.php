<?php

namespace App\Http\Requests\Dashboard\Faq;

use App\Models\User;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreFaqRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            "question.en" => "Required|string|max:250",
            "question.ar" => "Required|string|max:250",
            "answer.en" => "Required|string|max:250",
            "answer.ar" => "Required|string|max:250",
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


}
