<?php

namespace App\Http\Requests\Api\Screen\Sidebar\Chat;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class getChatRequest extends FormRequest
{
    use ValidationRequest;


    public function rules()
    {
        return [
            'chat_id'   => 'required|exists:chats,id',
            'after_id'  => 'nullable|integer|min:1',
        ];
    }
}
