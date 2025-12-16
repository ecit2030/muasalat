<?php

namespace App\Http\Requests\Api\Captain\Wallet;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator as Validation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreWalletRequest extends FormRequest
{
    use ValidationRequest;


    public function rules()
    {
        return [
            'balance' => 'required|numeric|min:1|max:' . auth()->user()->balance
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError($validator->errors()->first(), $validator->errors()));
    }
}
