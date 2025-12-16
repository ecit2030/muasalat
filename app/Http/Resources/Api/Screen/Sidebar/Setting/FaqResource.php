<?php

namespace App\Http\Resources\Api\Screen\Sidebar\Setting;

use App\Models\StudyPlan;
use App\Support\Api\Resource\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    use WithPagination;


    public function toArray($request): array
    {

        return [
            "id"         => $this->id,
            "question"   => $this->getTranslation("question" , requestLang()),
            "answer"     => $this->getTranslation("answer" , requestLang()),
        ];
    }
}
