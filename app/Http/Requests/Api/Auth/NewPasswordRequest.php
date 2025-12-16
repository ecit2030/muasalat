<?php

namespace App\Http\Requests\Api\Auth;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class NewPasswordRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        $rules = [
            'code' => ['required', 'numeric', 'digits:4', 'exists:otps,code'],
//            'password'  => ['required', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()],
            'password' => ['required','confirmed', Password::min(8), 'regex:/^(?=.*[A-Z])(?=.*\d).+$/'],
            'password_confirmation' => ['required', 'same:password'],
        ];
        if ($this->request->has('email')) {
            $rules['email'] = ['required', 'string', 'email:dns', 'exists:users,email'];
        } else {
            $rules['phone'] = ['required', 'phone:SA', 'numeric', 'exists:users,phone'];
        }
        return $rules;
    }

    public function messagesAction(): array
    {
        return [
            'code.numeric' => t_('the code field must be numeric.'),
            'code.digits' => t_('the code field must be 4 digits.'),
            'code.exists' => t_('the code field must be valid code.'),
        ];
    }
}
