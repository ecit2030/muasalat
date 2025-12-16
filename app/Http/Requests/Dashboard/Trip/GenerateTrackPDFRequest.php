<?php

namespace App\Http\Requests\Dashboard\Trip;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class GenerateTrackPDFRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'track' => 'required|exists:tracks,id',
            'date' => 'required|date',
            'time' => 'required|string',
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
