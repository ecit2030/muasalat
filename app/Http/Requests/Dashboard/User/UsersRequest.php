<?php

namespace App\Http\Requests\Dashboard\User;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:100',
            'is_active' => 'nullable',
            'avatar' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'phone' => 'string',
            'email' => 'required|email|max:255|unique:users,email,'.$this->route('user'),
            'password' => ['required', 'confirmed'],
            'roles' => 'nullable|array',
        ];

        if ($this->isMethod('PUT')) {
            $rules['password'] = ['nullable', 'confirmed'];
        }

        return $rules;
    }
}
