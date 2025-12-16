<?php

namespace Modules\Student\Transformers\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'full_name' => $this->full_name ?? $this->name,
            'email' => (string) $this->email,
            'phone' => $this->phone,
            'avatar' => $this->getFirstMediaUrl('avatar'),
            'role' => $this->roles()->first()->name ,
            "phoneVerified" => isset($this->phone_verified_at) ,
            "emailVerified" => isset($this->email_verified_at) ,
        ];
    }
}
