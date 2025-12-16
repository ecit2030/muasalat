<?php

namespace Modules\Vehicle\Http\Requests\Dashboard;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class VehicleModelRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return  [
            'vehicle_brand_id' => 'required|exists:vehicle_brands,id' ,
            'name.en' => 'required|unique:vehicle_models,name->en,'.request("vehicle_model") ,
            'name.ar' => 'required|unique:vehicle_models,name->ar,'.request("vehicle_model") ,
            "capacity" => "required|numeric"
        ];
    }


    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {

            if($validator->errors()->count() > 0){
                return redirect()->back()->withErrors($validator->errors()) ;
            }
        });
    }


}
