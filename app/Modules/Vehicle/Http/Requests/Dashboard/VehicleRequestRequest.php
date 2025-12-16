<?php

namespace Modules\Vehicle\Http\Requests\Dashboard;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class VehicleRequestRequest extends FormRequest
{
    use ValidationRequest;

    public function rules(Request $request)
    {
        $rules = [
            'content' => 'required|string',
        ];
        if (request()->isMethod('PUT')) {
            $rules['status'] = ['required','in:approved,rejected'];
        }
        return $rules;
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
