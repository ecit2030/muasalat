<?php

namespace App\Http\Requests\Dashboard\Wallet;

use App\Models\User;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreUserWithdrawRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'balance' => 'required|numeric|min:1'
        ];
    }


    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $moderator = auth()->user()->hasRole("moderator");
            $organization = auth()->user()->hasRole("organization");

            if ($organization) {
                $balance = auth()->user()->balance;
            } elseif ($moderator) {
                $balance = User::find(auth()->user()->organization_id)->balance;
            }

            if($balance == 0 ){
                $this->validator->errors()->add(
                    'has no balance',
                    t_("you have no balance")
                );
            }elseif($balance < $this->balance ){
                $this->validator->errors()->add(
                    'balance is not enough',
                    t_("balance is not enough")
                );
            }



            if ($validator->errors()) {
                return redirect()->back()->withErrors($validator);
            }
        });
    }

    public function messagesAction(): array
    {
        return [
            'balance.required' => t_('the balance field is required'),
        ];
    }
}
