<?php

use App\Http\Controllers\Dashboard\Notification\NotificationController;


Route::name("notifications")->resource("notifications", NotificationController::class);
Route::post("getReceivers", [NotificationController::class , "ajaxGetReceivers"])->name("ajaxGetReceivers");

