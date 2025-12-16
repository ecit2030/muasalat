<?php

namespace App\Http\Requests\Api\Client\TripV2;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator as Validation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class RateTripRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            "rate" => "required|numeric",
            "comment" => "nullable|string|max:190",
        ];
    }

    public function withValidator(Validation $validator)
    {
        $validator->after(function ($validator) {
        });
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError(__('messages.error_validation'), $validator->errors()));
    }
}
