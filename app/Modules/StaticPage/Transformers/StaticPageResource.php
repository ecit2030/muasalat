<?php

namespace Modules\StaticPage\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class StaticPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslation("title", requestLang()) ,
            'content' => isset($this->content[requestLang()]) ? $this->content[requestLang()] : "" ,
        ];
    }
}
