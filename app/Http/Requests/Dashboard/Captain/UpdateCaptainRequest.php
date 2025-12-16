<?php

namespace App\Http\Requests\Dashboard\Captain;

use App\Models\User;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Modules\Vehicle\Models\UserVehicle;
use Moltaqa\Wasl\Wasl;

class UpdateCaptainRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        $user = User::find(request("captain"));
        $vehicle = $user?->vehicle;
        $letters = Wasl::getInstance()->getVehiclePlateLetters() ?? [];
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email,' . $user?->id,
            'password' => ['nullable', 'confirmed'],
            'phone' => 'string|max:10|min:10|starts_with:05|unique:users,phone,' . $user?->id,
            'is_active' => 'nullable',
            "date_of_birth" => "required|date",
            "color" => "nullable|string|max:100",

            'vehicle_year_id' => 'nullable|exists:vehicle_years,id',
            'avatar' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'driver_license_number' => 'nullable|numeric',
            "driver_license_end_date" => "nullable|date|after:today",

            'sequence_number' => ['nullable', 'digits_between:8,10', Rule::unique('user_vehicles')->ignore($vehicle)],
            'vehicle_number' => "nullable|integer|digits:4",
            "vehicle_letter_right" => ["nullable", "string", 'min:1', 'max:1', Rule::in($letters)],
            "vehicle_letter_middle" => ["nullable", "string", 'min:1', 'max:1', Rule::in($letters)],
            "vehicle_letter_left" => ["nullable", "string", 'min:1', 'max:1', Rule::in($letters)],

            'driver_license' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            "ussid" => "nullable|image|mimes:png,jpeg,gif|max:5000",

            "ussid_number" => "nullable|numeric|unique:users,ussid_number," . $user?->id,

            "bank_name" => "nullable|string|max:100",
            "bank_personal_id" => "nullable|numeric|unique:users,bank_personal_id," . $user?->id,
            "iban" => 'nullable|string|unique:users,iban,' . $user?->id,

            "license_end_date" => 'nullable|date|after:today',
            "ensurance_end_date" => 'nullable|date|after:today',
            "periodic_end_date" => 'nullable|date|after:today',

            'vehicle_form' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'vehicle_license' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'vehicle_ensurance' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'vehicle_periodic' => 'nullable|image|mimes:png,jpeg,gif|max:5000',

            'vehicle' => 'nullable|array|max:4|min:4',
            'vehicle.*' => 'required|image|mimes:png,jpeg,gif|max:5000',

        ];
    }


    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {

            $user = User::find(request("captain"));
            $vehicleRecord = $user?->vehicle;

            $vehicle = UserVehicle::where([["vehicle_number", $this->vehicle_number], ["vehicle_letter", $this->vehicle_letter_right . $this->vehicle_letter_middle . $this->vehicle_letter_left]])->where("id", "!=", $vehicleRecord->id)->count();
            if ($vehicle) {
                $validator->errors()->add('vehicle_number', t_("vehicle_number_and_vehicle_letter_exsits_before"));
                $validator->errors()->add('vehicle_letter_right', t_("vehicle_number_and_vehicle_letter_exsits_before"));
                $validator->errors()->add('vehicle_letter_middle', t_("vehicle_number_and_vehicle_letter_exsits_before"));
                $validator->errors()->add('vehicle_letter_left', t_("vehicle_number_and_vehicle_letter_exsits_before"));
                return redirect()->back()->withErrors($validator->errors());
            };

            if ($validator->errors()) {
                return redirect()->back()->withErrors($validator);
            }
        });
    }

    public function attributes(): array
    {
        return [
            'sequence_number' => t_('vehicle sequence number'),
            'vehicle_number' => t_('vehicle number'),
            'vehicle_letter_right' => t_('vehicle letter right'),
            'vehicle_letter_middle' => t_('vehicle letter middle'),
            'vehicle_letter_left' => t_('vehicle letter left'),
        ];
    }
}
