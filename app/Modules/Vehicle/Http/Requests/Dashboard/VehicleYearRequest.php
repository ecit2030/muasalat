<?php

namespace Modules\Vehicle\Http\Requests\Dashboard;

use App\Support\Traits\ValidationRequest;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class VehicleYearRequest extends FormRequest
{
    use ValidationRequest;

    public function rules(Request $request)
    {
        $year = $this->route('year') ?? null;
        return  [
            'vehicle_model_id' => 'required|exists:vehicle_models,id' ,
            'year' => [ "required" , Rule::unique('vehicle_years')->where(fn (Builder $query) =>
                $query->where('vehicle_model_id', request("vehicle_model_id")))->ignore($year),
            ],
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
