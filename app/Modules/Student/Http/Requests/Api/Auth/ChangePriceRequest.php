<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePriceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        [$otherMin, $otherMax, $talebatMin, $talebatMax] = $this->price();

        return [
            'talebat_price' => 'required|numeric|lte:' . $talebatMax . '|gte:' . $talebatMin,
            'other_price'   => 'required|numeric|lte:' . $otherMax . '|gte:' . $otherMin,
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages(): array
    {
        [$otherMin, $otherMax, $talebatMin, $talebatMax] = $this->price();

        return [
            'password.min' => t_('The password field must not be less than 4 characters.'),
            'email.required' => t_('email is required'),
            'email.unique' => t_('email is unique'),
            'name.required' => t_('email is unique'),
            'password.confirmed' => t_('password is confirmed'),
            'password.required' => t_('password is required'),


            'talebat_price.required' =>  t_("talebat price") . " " . t_('field is required.'),
            'talebat_price.lte' => t_("talebat price") . " " . t_('must be less than or equal') . " " . $talebatMax,
            'talebat_price.gte' => t_("talebat price") . " " . t_('must be more than or equal') . " " . $talebatMin,

            'other_price.required' =>  t_("other price") . " " . t_('field is required.'),
            'other_price.lte' => t_("other price") . " " . t_('must be less than or equal') . " " . $otherMax,
            'other_price.gte' => t_("other price") . " " . t_('must be more than or equal') . " " . $otherMin,
        ];
    }

    private function price()
    {
        $price = setting('price');
        $otherMin = data_get($price, 'other_min', '1');
        $otherMax = data_get($price, 'other_max', '10');
        $talebatMin = data_get($price, 'talebat_min', '1');
        $talebatMax = data_get($price, 'talebat_max', '10');

        return [$otherMin, $otherMax, $talebatMin, $talebatMax];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError(__('validation.error_validation'), $validator->errors()));
    }
}
