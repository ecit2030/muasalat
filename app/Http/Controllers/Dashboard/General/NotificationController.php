<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Http\Request;

class NotificationController extends DashboardController
{
    /**
     * change locale.
     *
     * @var  @locale
     */
    public function mark(Request $request)
    {
        auth()->guard(activeGuard())->user()?->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
}
