<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Helpers\NotificationMap;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Modules\Student\Http\Resources\NotificationResource;

class NotificationController extends ApiController
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        auth()->user()->notifications()->whereNull("read_at")->update([
            "read_at" => Carbon::now()
        ]);

        // return $this->successResponse([
        //     'notifications' => $notifications->map(function ($notification) {
        //         return NotificationMap::getMessage($notification);
        //     }),
        // ]);

        return $this->successResponse(NotificationResource::collection($notifications));

    }


}
