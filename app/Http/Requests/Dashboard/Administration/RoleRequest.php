<?php

namespace App\Http\Requests\Dashboard\Administration;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'name' => 'required|string|max:191|not_in:admin,user,super|unique:roles,name,'.request()->route('role'),
            'permissions' => 'min:1|array',
        ];
    }

    public function messagesAction(): array
    {
        return [
            'name.not_in' => t_('The name field not valid'),
        ];
    }
}
