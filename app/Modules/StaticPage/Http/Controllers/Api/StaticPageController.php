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

    public function privacy_client()
    {
        return $this->successResponse(StaticPageResource::make(StaticPage::find(6)));
    }

    public function terms_client()
    {
        return $this->successResponse(StaticPageResource::make(StaticPage::find(4)));
    }
    
    public function privacy_driver()
    {
        return $this->successResponse(StaticPageResource::make(StaticPage::find(7)));
    }

    public function terms_driver()
    {
        return $this->successResponse(StaticPageResource::make(StaticPage::find(5)));
    }

    public function about()
    {
        return $this->successResponse(StaticPageResource::make(StaticPage::find(3)));
    }

}
