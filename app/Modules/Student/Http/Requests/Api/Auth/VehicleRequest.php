<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Modules\Vehicle\Models\UserVehicle;
use Moltaqa\Wasl\Wasl;

class VehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "vehicle_year_id" => "required|exists:vehicle_years,id",
            'sequence_number' => ['required','digits_between:8,10',Rule::unique('user_vehicles')],
            'vehicle_number' => "required|integer|digits:4",
            "vehicle_letter" => "required|min:3|max:6",
            "color" => "required|string|max:100",

//            "license_end_date" => 'required|date|after:today',
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
        $vehicle = UserVehicle::where([["vehicle_number" , $this->vehicle_number ] , [ "vehicle_letter" , $this->vehicle_letter]])->first();
        if ($vehicle) {
            $validator->errors()->add('vehicle_number', __("validation.not_valid_vehicle_pallete"));

            throw new HttpResponseException( sendError(__('validation.not_valid_vehicle_pallete'), $validator->errors()));
        }

//        $letters = mb_str_split($this->vehicle_letter);
//        foreach ($letters as $letter){
//            if(!in_array($letter,Wasl::getInstance()->getVehiclePlateLetters())){
//                $validator->errors()->add('vehicle_letter', __("validation.not_valid_vehicle_pallete_letter"));
//                throw new HttpResponseException( sendError(__('validation.not_valid_vehicle_pallete_letter'), $validator->errors()));
//            }
//        }
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
    public function messages()
    {
        return [
            'vehicle_year_id.required' => __('vehicle year is required'),
            'vehicle_year_id.exists' => __('vehicle year not valid'),
            'vehicle_number.required' => __('vehicle number is required'),
            'vehicle_letter.required' => __('vehicle letter is required'),
            'color.required' => __('color is required'),

            'license_end_date.required' => __('license end date is required'),
            'license_end_date.date' => __('license end date must be date'),
            'license_end_date.after' => __('license end date must be after today'),

            'ensurance_end_date.required' => __('ensurance end date is required'),
            'ensurance_end_date.date' => __('ensurance end date must be date'),
            'ensurance_end_date.after' => __('ensurance end date must be after today'),

            'periodic_end_date.required' => __('periodic end date is required'),
            'periodic_end_date.date' => __('periodic end date must be date'),
            'periodic_end_date.after' => __('periodic end date must be after today'),

            'vehicle_license.required' => __('vehicle license is required'),
            'vehicle_license.image' => __('vehicle license must be type image'),

            'vehicle_ensurance.required' => __('vehicle ensurance is required'),
            'vehicle_ensurance.image' => __('vehicle ensurance must be type image'),

            'vehicle_periodic.required' => __('vehicle periodic is required'),
            'vehicle_periodic.image' => __('vehicle periodic must be type image'),

            'vehicle_form.required' => __('vehicle form is required'),
            'vehicle_form.image' => __('vehicle form must be type image'),


        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError(__('validation.error_validation'), $validator->errors()));
    }

    public function attributes(): array
    {
        return [
            'sequence number'=>t_('vehicle sequence number'),
        ];
    }
}
