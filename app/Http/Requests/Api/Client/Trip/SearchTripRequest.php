<?php

namespace App\Http\Requests\Api\Client\Trip;

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
            "origin.lat" => "required|string|max:100",
            "origin.lng" => "required|string|max:100",
            "destination.lat" => "required|string|max:100",
            "destination.lng" => "required|string|max:100",
            "start_date" => "required|after:yesterday",
            "end_date" => "required|after:yesterday",
            "time" => "required|date_format:H:i",
            "repeat"=>"required|array|max:1|min:1",
            "type"=>"required|in:other",
            "repeat.*"=>"required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday"
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
