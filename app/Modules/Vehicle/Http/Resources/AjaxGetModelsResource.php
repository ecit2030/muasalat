<?php

namespace Modules\Vehicle\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class AjaxGetModelsResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            "id" => $this->id ,
            "name" => $this->name ,
            "nameCapacity" => $this->nameCapacity ,
        ]
;
    }
}
