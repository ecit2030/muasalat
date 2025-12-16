<?php

namespace App\Http\Resources\Api\General;

use App\Support\Api\Resource\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageRecourse extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'flag' => asset($this->flag),
            'code' => (string) $this->code,
        ];
    }
}
