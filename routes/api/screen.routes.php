<?php


use App\Http\Controllers\Api\Screen\Sidebar\SettingController;
use Modules\StaticPage\Http\Controllers\Api\StaticPageController;
use Illuminate\Support\Facades\Route;

// SIDEBAR
Route::middleware('auth:sanctum')->group(function () {

    Route::get('notification', [SettingController::class, 'getNotifications']);
    Route::get('notification-data', [SettingController::class, 'getNotifications']);
    Route::get('toggle-notification', [SettingController::class, 'toggleNotifications']);

    Route::post('chat/send', [SettingController::class, 'sendMessage']);
    Route::post('chat/single', [SettingController::class, 'getChat']);
    Route::get('chat/page', [SettingController::class, 'getMessage']);
});


Route::middleware('guest')->as('auth.')->group(function () {

    // STATIC PAGES
Route::group(['prefix' => 'static_pages'], function () {
    Route::get('terms', [StaticPageController::class, 'terms']);
    Route::get('privacy', [StaticPageController::class, 'privacy']);
    Route::get('about', [StaticPageController::class, 'about']);
});

// CONATCT US
Route::post('contact_us', [SettingController::class, 'contactUs'])->name("contactUs");

Route::get('emergency-number', [SettingController::class, 'emergencyNumber']);

// Faq
Route::get('faq', [SettingController::class, 'Faq']);
});


