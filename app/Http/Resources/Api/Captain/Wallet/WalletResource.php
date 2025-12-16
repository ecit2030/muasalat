<?php

namespace App\Http\Resources\Api\Captain\Wallet;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class WalletResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            'id'=> $this->id,
            'balance'=> (int) $this->balance,
            'status'=> (string) $this->status,
            "clientOrderDate" => $this->created_at ,
            "adminResponseDate" => (string) $this->admin_date
        ];
    }
}
