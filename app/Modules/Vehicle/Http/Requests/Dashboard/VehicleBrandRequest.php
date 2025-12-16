<?php

namespace Modules\Vehicle\Http\Requests\Dashboard;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class VehicleBrandRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return  [
            'name.en' => 'required|unique:vehicle_brands,name->en,'.request("vehicle_brand") ,
            'name.ar' => 'required|unique:vehicle_brands,name->ar,'.request("vehicle_brand") ,
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
