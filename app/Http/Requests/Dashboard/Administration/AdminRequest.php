<?php

namespace App\Http\Requests\Dashboard\Administration;

use App\Models\Role;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        [$otherMin, $otherMax, $talebatMin, $talebatMax] = $this->price();
        $rules = [
            'name' => 'required|string|max:100',
            'password' => ['required', 'confirmed', Password::defaults()],
            'avatar' => 'nullable|image|max:2048',
            'is_active' => 'nullable',
        ];

        if (request()->isMethod('PUT')) {
            $rules['roles'] = ['nullable', 'array', 'min:1'];
            $rules['email'] = 'required|email|max:255|unique:users,email,' . auth()->id() . ',id';
            $rules['roles.*'] = ['required', Rule::in(Role::whereNotIn('id', [1])->pluck('name')->toArray())];
            $rules['password'] = ['nullable', 'confirmed', Password::defaults()];
        } else {
            $rules['roles'] = ['required', 'array', 'min:1'];
            $rules['email'] = 'required|email|max:255|unique:users,email';
            $rules['roles.*'] = ['required', Rule::in(Role::whereNotIn('id', [1])->pluck('name')->toArray())];
        }

        if (is_array(request('roles')) && in_array('organization', request('roles'))) {
            $rules['talebat_price'] = 'required|numeric|lte:' . $talebatMax . '|gte:' . $talebatMin;
            $rules['other_price'] = 'required|numeric|lte:' . $otherMax . '|gte:' . $otherMin;
        } else {
            $rules['talebat_price'] = 'nullable|numeric|lte:' . $talebatMax . '|gte:' . $talebatMin;
            $rules['other_price'] = 'nullable|numeric|lte:' . $otherMax . '|gte:' . $otherMin;
        }

        return $rules;
    }

    public function messagesAction(): array
    {
        [$otherMin, $otherMax, $talebatMin, $talebatMax] = $this->price();

        return [
            'password.min' => t_('The password field must not be less than 4 characters.'),
            'email.required' => t_('email is required'),
            'email.unique' => t_('email is unique'),
            'name.required' => t_('email is unique'),
            'password.confirmed' => t_('password is confirmed'),
            'password.required' => t_('password is required'),


            'talebat_price.required' => t_("talebat price") . " " . t_('field is required.'),
            'talebat_price.lte' => t_("talebat price") . " " . t_('must be less than or equal') . " " . $talebatMax,
            'talebat_price.gte' => t_("talebat price") . " " . t_('must be more than or equal') . " " . $talebatMin,

            'other_price.required' => t_("other price") . " " . t_('field is required.'),
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
}
