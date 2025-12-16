<?php

namespace Modules\Student\Http\Requests\Admin;

use App\Rules\SaPhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'nationality_id' => 'required|exists:nationalities,id',
            'gender' => 'required|min:1|max:2',
            'city_id' => 'required|exists:cities,id',
            'email'  => 'required|email:filter|unique:clients,email,' . $this->client->id,
            'phone'  => ['required', 'unique:clients,phone,' . $this->client->id, new SaPhoneRule()],
            'password' => [
                'nullable', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ,
            ],
            'image' => 'nullable|image',
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
}
