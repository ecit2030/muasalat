<?php

namespace App\Http\Requests\Api\Captain\Trip;

use App\Support\Helper\MhelperClass;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator as Validation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class CancelTripRequest extends FormRequest
{
    use ValidationRequest;

    public function __construct(private MhelperClass $helper)
    {
    }


    public function rules()
    {
        return [
            'trip_id' => 'required|numeric',
            'cancel_reason' => 'required',
            'driver_current_lat' => 'nullable',
            'driver_current_long' => 'nullable',
        ];
    }






    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError(__('messages.error_validation'), $validator->errors()));
    }
}
