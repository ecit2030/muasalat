<?php

namespace Modules\StaticPage\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function messages()
    {
        return [
            'ar.name.required' => 'يجب إدخال الاسم بالعربي',
            'en.name.required' => 'يجب إدخال الاسم بالإنجليزي',
            'ar.content.required' => 'يجب إدخال المحتوي بالعربي',
            'en.content.required' => 'يجب إدخال المحتوي بالإنجليزي',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ar.name' => 'required|string|max:255',
            'en.name' => 'required|string|max:255',
            'ar.content' => 'required|string',
            'en.content' => 'required|string',
        ];
    }
}
