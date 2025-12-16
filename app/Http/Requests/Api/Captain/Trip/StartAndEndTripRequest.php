<?php

namespace App\Http\Requests\Api\Captain\Trip;

use App\Support\Helper\MhelperClass;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator as Validation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StartAndEndTripRequest extends FormRequest
{
    use ValidationRequest;

    public function __construct(private MhelperClass $helper)
    {
    }


    public function rules()
    {
        return [
            'trip_id' => 'required|numeric',
//            'track_id' => 'required|numeric',
//            'date' => 'required|date',
        ];
    }






    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError(__('messages.error_validation'), $validator->errors()));
    }
}
