<?php

namespace App\Http\Requests\Api\Auth;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;

class PasswordResetLinkRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        $rules = [];
        if ($this->request->has('email')) {
            $rules['email'] = ['required', 'string', 'email:dns', 'exists:users,email'];
        } else {
            $rules['phone'] = ['required', 'phone:AUTO,SA', 'numeric', 'exists:users,phone'];
        }
        return $rules;
    }
}
