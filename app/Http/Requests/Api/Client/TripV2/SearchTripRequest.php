<?php

namespace App\Http\Requests\Api\Client\TripV2;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator as Validation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchTripRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            "origin.lat" => "required|numeric",
            "origin.lng" => "required|numeric",
            "destination.lat" => "required|numeric",
            "destination.lng" => "required|numeric",
            "date" => "required|after:yesterday",
            "time" => "required|date_format:H:i",
            'type' => 'required|in:other,talebat'
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
