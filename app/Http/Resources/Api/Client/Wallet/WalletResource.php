<?php

namespace App\Http\Resources\Api\Client\Wallet;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class WalletResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'steps' => number_format($this->steps,2),
            'transaction_type' => $this->transaction_type,
            'transaction_reason' => $this->transaction_reasons,
            'transaction_reason_translated' => __('messages.'.$this->transaction_reasons),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
