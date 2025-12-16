<?php

namespace App\Http\Requests\Dashboard\Captain;

use App\Models\User;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Modules\Vehicle\Models\UserVehicle;
use Moltaqa\Wasl\Wasl;

class StoreCaptainRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        $letters = Wasl::getInstance()->getVehiclePlateLetters() ?? [];
        return  [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed'],
            'phone' => 'required|string|max:10|min:10|starts_with:05|unique:users,phone',
            'is_active' => 'nullable',
            "date_of_birth" => "required|date",
            "color" => "required|string|max:100",

            'vehicle_year_id' => 'required|exists:vehicle_years,id',
            'avatar' => 'nullable|image|mimes:png,jpeg,gif|max:5000',
            'driver_license_number' => 'required|numeric',

//            "driver_license_end_date"  => "required|date|after:today" ,

            'sequence_number' => ['required','digits_between:8,10','unique:user_vehicles,sequence_number'],
            'vehicle_number' => "required|integer|digits:4",
            "vehicle_letter_right" => ["required" , "string" , 'min:1' , 'max:1' , Rule::in($letters)],
            "vehicle_letter_middle" => ["required" , "string" , 'min:1' , 'max:1' , Rule::in($letters)],
            "vehicle_letter_left" => ["required" , "string" , 'min:1' , 'max:1' , Rule::in($letters)],

            'driver_license' => 'required|image|mimes:png,jpeg,gif|max:5000',
            "ussid" => "required|image|mimes:png,jpeg,gif|max:5000",

            "ussid_number" => "required|numeric|unique:users,ussid_number",

            "bank_name" => "required|string|max:100",
            "bank_personal_id" => "required|numeric|unique:users,bank_personal_id",
            "iban" => 'required|string|unique:users,iban',

            "license_end_date" => 'required|date|after:today',
//            "ensurance_end_date" => 'required|date|after:today',
//            "periodic_end_date" => 'required|date|after:today',

//            'vehicle_form'  => 'required|image|mimes:png,jpeg,gif|max:5000',
            'vehicle_license'  => 'required|image|mimes:png,jpeg,gif|max:5000',
            'vehicle_ensurance'  => 'required|image|mimes:png,jpeg,gif|max:5000',
//            'vehicle_periodic'  => 'required|image|mimes:png,jpeg,gif|max:5000',

            'vehicle'  => 'array|max:4|min:4',
            'vehicle.*'  => 'required|image|mimes:png,jpeg,gif|max:5000',

        ];
    }


    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {

            $vehicle = UserVehicle::where([["vehicle_number", $this->vehicle_number], ["vehicle_letter", $this->vehicle_letter_right.$this->vehicle_letter_middle.$this->vehicle_letter_left]])->first();
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
