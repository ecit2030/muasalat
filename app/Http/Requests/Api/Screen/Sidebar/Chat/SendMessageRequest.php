<?php

namespace App\Http\Requests\Api\Screen\Sidebar\Chat;

use Illuminate\Foundation\Http\FormRequest;


class SendMessageRequest extends FormRequest
{
    // use ValidationRequest;

    public function rules()
    {
        return [
            'receiver_id' => 'required|numeric',
            'message'     => 'required|string',
            'chat_id'     => 'required|string',
        ];
    }
}
