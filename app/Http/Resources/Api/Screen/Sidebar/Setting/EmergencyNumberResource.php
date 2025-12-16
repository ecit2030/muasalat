<?php

namespace App\Http\Resources\Api\Screen\Sidebar\Setting;

use App\Models\StudyPlan;
use App\Support\Api\Resource\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyNumberResource extends JsonResource
{
    use WithPagination;


    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
