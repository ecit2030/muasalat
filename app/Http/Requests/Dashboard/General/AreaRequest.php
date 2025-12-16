<?php

namespace App\Http\Requests\Dashboard\General;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class AreaRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'title' => 'required|array|min:1',
            'title.*' => 'required|string|max:100|min:2',
            'active' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:areas,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'address' => 'nullable|string|max:255|min:2',
            'flag' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
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
            'title.*.required' => t_('the title field is required'),
            'title.*.min' => t_('the title field must not be less than 2 characters.'),
            'title.*.max' => t_('the title field must not be less than 9999999999 characters.'),
        ];
    }
}
