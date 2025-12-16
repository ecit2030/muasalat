<?php

namespace App\Http\Requests\Dashboard\User;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
