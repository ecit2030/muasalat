<?php

namespace App\Http\Requests\Api\Client\Trip;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator as Validation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreTripRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
//            "track_id" => "required|exists:tracks,id",
            "start_date" => "required|after:yesterday",
            "end_date" => "required|after:yesterday",
            "time" => "required|date_format:H:i",
            "type" => "required|in:other",
            "repeat" => "required|array|max:7|min:1",
            "repeat.*" => "required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday",
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
