<?php

namespace Modules\Student\Http\Requests\Api\Auth;

use App\Models\User;
use App\Rules\SaPhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Vehicle\Models\UserVehicle;
use Moltaqa\Wasl\Wasl;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = auth()->user()->load('vehicle');
        $id = auth()->id();
        [$otherMin, $otherMax, $talebatMin, $talebatMax] = $this->price();

        return [
            'name'               => 'nullable|string|max:255',
            'username'               => 'nullable|string|max:255',
            'full_name'               => 'nullable|string|max:255',
            'email'              => 'nullable|email|unique:users,email,' . $id,

            "date_of_birth"      => "nullable|date|before:today",
            "ussid_number"       => 'nullable|numeric|unique:users,ussid_number,' . $id,
            "ussid"              => "nullable|image|mimes:png,jpeg,gif|max:5000",
            "avatar"             => "nullable|image|mimes:png,jpeg,gif|max:5000",
            "driver_license"     => "nullable|image|mimes:png,jpeg,gif|max:5000",
            "bank_name"          => "nullable|string|max:100",
            "bank_personal_id"   => "nullable|numeric|unique:users,bank_personal_id," . $id,
            "driver_license_number"   => "nullable|numeric|unique:users,driver_license_number," . $id,
            "iban"                      => "nullable|string|unique:users,iban," . $id,
            "driver_license_end_date"  => "nullable|date|after:today",

//            'talebat_price' => 'required|numeric|lte:' . $talebatMax . '|gte:' . $talebatMin,
//            'other_price'   => 'required|numeric|lte:' . $otherMax . '|gte:' . $otherMin,

            "vehicle_year_id"    => "nullable|exists:vehicle_years,id",
            'vehicle_number'     => "nullable|integer|digits:4",
            "vehicle_letter"     => "nullable|min:3|max:3",
            'sequence_number' => [request()->user()->hasRole('user') ? 'nullable' : 'required','digits_between:8,10',Rule::unique('user_vehicles')->ignore($user?->vehicle?->id)],
            "color"              => "nullable|string|max:100",

//            "license_end_date"   => 'nullable|date|after:today',
//            "ensurance_end_date" => 'nullable|date|after:today',
//            "periodic_end_date"  => 'nullable|date|after:today',

//            'vehicle_form'       => 'nullable|image|mimes:png,jpeg,gif|max:5000',
//            'vehicle_license'    => 'nullable|image|mimes:png,jpeg,gif|max:5000',
//            'vehicle_ensurance'  => 'nullable|image|mimes:png,jpeg,gif|max:5000',
//            'vehicle_periodic'   => 'nullable|image|mimes:png,jpeg,gif|max:5000',

            'vehicle'            => 'array|max:4|min:4',
            'vehicle.*'          => 'nullable|image|mimes:png,jpeg,gif|max:5000',

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

    public function messages()
    {
        [$otherMin, $otherMax, $talebatMin, $talebatMax] = $this->price();

        return [
            'name.nullable' => __('Name is nullable'),
            'name.string' => __('Name is nullable'),
            'email.nullable' => __('Email is nullable'),
            'email.email' => __('Invalid email'),
            'email.unique' => __('This mail is used before'),


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

    public function withValidator(Validator $validator)
    {
        $user = auth()->user()->load('vehicle');

        $vehicle = UserVehicle::whereNotIn('id',[$user->vehicle?->id])->where([["vehicle_number" , $this->vehicle_number ] , [ "vehicle_letter" , $this->vehicle_letter]])->first();
        if ($vehicle) {
            $validator->errors()->add('vehicle_number', __("validation.not_valid_vehicle_pallete"));
            throw new HttpResponseException( sendError(__('validation.not_valid_vehicle_pallete'), $validator->errors()));
        }

        $letters = mb_str_split($this->vehicle_letter) ?? [];
        if(is_array($letters) && !empty($letters)){
            foreach ($letters as $letter){
                if(!in_array($letter,Wasl::getInstance()->getVehiclePlateLetters())){
                    $validator->errors()->add('vehicle_letter', __("validation.not_valid_vehicle_pallete_letter"));
                    throw new HttpResponseException( sendError(__('validation.not_valid_vehicle_pallete_letter'), $validator->errors()));
                }
            }
        }
    }
}
