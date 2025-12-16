<?php

use App\Http\Controllers\Dashboard\Setting\SettingController;

route_group('setting', function () {
    Route::get('/', [SettingController::class, 'index'])->name('index');
    Route::post('general/submit', [SettingController::class, 'generalSubmit'])->name('general-submit');
    Route::post('media/submit', [SettingController::class, 'mediaSubmit'])->name('media-submit');
    Route::post('numbers/submit', [SettingController::class, 'emregencySubmit'])->name('numbers-submit');
    Route::post('social/submit', [SettingController::class, 'socialSubmit'])->name('social-submit');
    Route::post('price/submit', [SettingController::class, 'priceSubmit'])->name('price-submit');
    Route::post('emails', [SettingController::class, 'emailsSubmit'])->name('emails-submit');
    Route::post('api-keys', [SettingController::class, 'apiKeysSubmit'])->name('api-keys-submit');
});
