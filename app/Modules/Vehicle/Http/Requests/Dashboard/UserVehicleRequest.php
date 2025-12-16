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

class UserVehicleRequest extends FormRequest
{
    use ValidationRequest;

    public function rules(Request $request)
    {
        $letters = Wasl::getInstance()->getVehiclePlateLetters() ?? [];
        return  [
            'vehicle_brand_id' => 'required|exists:vehicle_brands,id,deleted_at,NULL',
            'vehicle_model_id' => 'required|exists:vehicle_models,id,deleted_at,NULL',
            'vehicle_year_id'  => 'required|exists:vehicle_years,id,deleted_at,NULL',
            'is_active' => 'nullable',
            'sequence_number' => ['required','digits_between:8,10','unique:user_vehicles,sequence_number'],
            'vehicle_number' => "required|integer|digits:4",
            "vehicle_letter_right" => ["required" , "string" , Rule::in($letters)],
            "vehicle_letter_middle" => ["required" , "string" , Rule::in($letters)],
            "vehicle_letter_left" => ["required" , "string" , Rule::in($letters)],
            "color" => "required|string|max:100",
            "license_end_date" => 'required|date|after:today',
            "ensurance_end_date" => 'required|date|after:today',
            "periodic_end_date" => 'required|date|after:today',
            'vehicle_form'  => 'required|image|mimes:png,jpeg,gif|max:5000',
            'vehicle_license'  => 'required|image|mimes:png,jpeg,gif|max:5000',
            'vehicle_ensurance'  => 'required|image|mimes:png,jpeg,gif|max:5000',
            'vehicle_periodic'  => 'required|image|mimes:png,jpeg,gif|max:5000',
            'vehicle'  => 'array|max:4|min:4',
            'vehicle.*'  => 'required|image|mimes:png,jpeg,gif|max:5000',
        ];
    }



    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {

            $vehicle = UserVehicle::where("vehicle_number", $this->vehicle_number)->where("vehicle_letter", $this->vehicle_letter_right.$this->vehicle_letter_middle.$this->vehicle_letter_left)->first();
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

    public function messagesAction(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [
            'sequence_number' => t_('vehicle sequence number'),
            'vehicle_number' => __('vehicle number'),
            'vehicle_letter_right' => t_('vehicle letter right'),
            'vehicle_letter_middle' => t_('vehicle letter middle'),
            'vehicle_letter_left' => t_('vehicle letter left'),
        ];
    }

    public function messages()
    {
        return [
            'vehicle.min' => __('vehicle photos must be 4 photos'),
            'vehicle.max' => __('vehicle photos must be 4 photos'),
        ];
    }
}
