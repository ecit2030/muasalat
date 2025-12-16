<?php

namespace Modules\StaticPage\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Modules\StaticPage\Entities\StaticPage;
use Modules\StaticPage\Transformers\StaticPageResource;

class StaticPageController extends ApiController
{
    public function privacy()
    {
        return $this->successResponse(StaticPageResource::make(StaticPage::find(1)));
    }

    public function terms()
    {
        return $this->successResponse(StaticPageResource::make(StaticPage::find(2)));
    }

    public function about()
    {
        return $this->successResponse(StaticPageResource::make(StaticPage::find(3)));
    }

}
