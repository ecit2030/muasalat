<?php

namespace App\Http\Requests\Api\Client\Trip;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator as Validation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreTalebatRequest extends FormRequest
{
    use ValidationRequest;


    public function rules()
    {
        return [

            "type"=>"required|in:talebat,other",
            "tracks" => "required|array" ,
            "tracks.*.track_id" => "required|exists:tracks,id" ,
            "tracks.*.date" => "required|date|date_format:Y-m-d" ,
            "tracks.*.distance" => "required|numeric" ,
            "tracks.*.start_time" => "required|string" ,
            "tracks.*.origin.lat" => "required|numeric" ,
            "tracks.*.origin.lng" => "required|numeric" ,
            "tracks.*.destination.lat" => "required|numeric" ,
            "tracks.*.destination.lng" => "required|numeric" ,
            "start_date" => "required|after:yesterday",
            "end_date" => "required|after:yesterday",
            "origin" => "required|array",
            "destination" => "required|array",
            "repeat"=>"required|array|max:7|min:1",
            "repeat.*.day"=>"required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday" ,
            "repeat.*.go" => "required|date_format:H:i",
            "repeat.*.return" => "required|date_format:H:i|after:repeat.*.go",
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
