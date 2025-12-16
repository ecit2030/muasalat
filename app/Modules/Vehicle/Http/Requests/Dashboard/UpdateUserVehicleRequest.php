<?php

namespace Modules\Vehicle\Http\Requests\Dashboard;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;
use Modules\Vehicle\Models\UserVehicle;
use Moltaqa\Wasl\Wasl;

class UpdateUserVehicleRequest extends FormRequest
{
    use ValidationRequest;

    public function rules(Request $request)
    {
        $letters = Wasl::getInstance()->getVehiclePlateLetters() ?? [];
        return [
            'vehicle_brand_id' => 'exists:vehicle_brands,id,deleted_at,NULL',
            'vehicle_model_id' => 'exists:vehicle_models,id,deleted_at,NULL',
            'vehicle_year_id' => 'exists:vehicle_years,id,deleted_at,NULL',
            'is_active' => 'nullable',
            'sequence_number' => ['required', 'digits_between:8,10', Rule::unique('user_vehicles')->ignore($this->route('user_vehicle'))],
            'vehicle_number' => "required|integer|digits:4",
            "vehicle_letter_right" => ["required", "string", 'min:1', 'max:1', Rule::in($letters)],
            "vehicle_letter_middle" => ["required", "string", 'min:1', 'max:1', Rule::in($letters)],
            "vehicle_letter_left" => ["required", "string", 'min:1', 'max:1', Rule::in($letters)],
            "color" => "string|max:100",

            "license_end_date" => 'date|after:today',
            "ensurance_end_date" => 'date|after:today',
            "periodic_end_date" => 'date|after:today',

            'vehicle_form' => 'image|mimes:png,jpeg,gif|max:5000',
            'vehicle_license' => 'image|mimes:png,jpeg,gif|max:5000',
            'vehicle_ensurance' => 'image|mimes:png,jpeg,gif|max:5000',
            'vehicle_periodic' => 'image|mimes:png,jpeg,gif|max:5000',

            'vehicle' => 'array|max:4|min:4',
            'vehicle.*' => 'image|mimes:png,jpeg,gif|max:5000',

        ];
    }


    public function withValidator(Validator $validator)
    {

        $validator->after(function ($validator) {
            $vehicle = UserVehicle::where([["vehicle_number", $this->vehicle_number], ["vehicle_letter", $this->vehicle_letter_right . $this->vehicle_letter_middle . $this->vehicle_letter_left]])->where("id", "!=", $this->route('user_vehicle')->id)->count();
            if ($vehicle) {
                $validator->errors()->add('vehicle_number', t_("vehicle_number_and_vehicle_letter_exsits_before"));
                $validator->errors()->add('vehicle_letter_right', t_("vehicle_number_and_vehicle_letter_exsits_before"));
                $validator->errors()->add('vehicle_letter_middle', t_("vehicle_number_and_vehicle_letter_exsits_before"));
                $validator->errors()->add('vehicle_letter_left', t_("vehicle_number_and_vehicle_letter_exsits_before"));
                return redirect()->back()->withErrors($validator->errors());
            };
        });
    }

    public function messagesAction(): array
    {
        return [];
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
