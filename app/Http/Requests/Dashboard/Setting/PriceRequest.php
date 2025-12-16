<?php

namespace App\Http\Requests\Dashboard\Setting;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PriceRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'price.talebat_min' => 'numeric|min:1|lt:price.talebat_max',
            'price.talebat_max' => 'numeric',
            'price.other_min'   => 'numeric|lt:price.other_max|min:1',
            'price.other_max'   => 'numeric',
            'price.discount_from_driver_when_cancel_trip'   => 'numeric',
            'price.discount_from_client_when_cancel_trip'   => 'numeric',

        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {

            if ($validator->errors()) {
                return redirect()->back()->withErrors($validator);
            }
        });
    }


    public function messagesAction(): array
    {
        return [
            'price.talebat_min.numeric' =>  t_("talebat min") . " " . t_('price must be number'),
            'price.talebat_max.numeric' =>  t_("talebat max") . " " . t_('price must be number'),
            'price.other_min.numeric'   =>  t_("other min") . " " . t_('price must be number'),
            'price.other_max.numeric'   =>  t_("other max") . " " . t_('price must be number'),


            'price.talebat_min.lt' => t_('talebat min price must be less than talebat max price'),
            'price.other_min.lt' => t_('talebat min price must be less than talebat max price'),

            'price.talebat_min.min' => t_('other min must be more than 0'),
            'price.other_min.min' => t_('other min must be more than 0'),
        ];
    }
}
