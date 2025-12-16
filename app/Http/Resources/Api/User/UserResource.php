<?php

namespace App\Http\Resources\Api\User;

use App\Support\Api\Resource\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'phone' => (string) $this->phone,
            'email' => (string) $this->email,
            'avatar' => (string) $this->avatar,
        ];
    }
}
