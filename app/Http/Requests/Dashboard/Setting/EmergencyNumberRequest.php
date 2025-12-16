<?php

namespace App\Http\Requests\Dashboard\Setting;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use function Symfony\Component\Translation\t;

class EmergencyNumberRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'numbers' => ['nullable','array','min:1'],
            'numbers.*' => ['required','numeric', 'phone:AUTO,SA'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $array = $this->numbers;
            $uniqueValues = array_unique($array);
            if(count($array) !== count($uniqueValues)){
                $this->validator->errors()->add(
                    'numbers.duplicate',
                    t_("you can't add duplicate a phone number")
                );
            }
            if ($validator->errors()) {
                return redirect()->back()->withErrors($validator);
            }
        });
    }

    public function messagesAction(): array
    {
        return [
            'numbers.*.phone' => t_('emergency number must be valid number.'),
        ];
    }

    public function attributes()
    {
        return [
            'numbers' => t('Emergency Numbers'),
        ];
    }
}
