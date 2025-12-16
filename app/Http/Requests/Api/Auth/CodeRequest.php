<?php

namespace App\Http\Requests\Api\Auth;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;

class CodeRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'phone' => ['required', 'phone:AUTO,SA', 'numeric', 'exists:users,phone'],
            'code' => ['required', 'numeric', 'digits:4', 'exists:otps,code'],
        ];
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
