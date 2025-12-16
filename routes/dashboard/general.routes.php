<?php

use App\Http\Controllers\Dashboard\General\Administration\AdminController;
use App\Http\Controllers\Dashboard\General\Administration\RoleController;

route_group('general', function () {
    route_group('administration', function () {
        Route::get('profile', 'AdminProfileController@index')->name('profile.index');
        Route::put('profile', 'AdminProfileController@update')->name('profile.update');
        Route::post('activation', [AdminController::class , "activation"])->name('admin.acivation');

        Route::resources([
            'admins' => 'AdminController',
            'roles' => 'RoleController',
        ]);

        Route::middleware("role:admin|organization")
        ->post('role/activation',[ RoleController::class , "activation"])->name("role.activation");

    });

    Route::resources([
        'areas' => 'AreaController',
        'pages' => 'PageController',
    ]);

    //TODO::controller dosnt exist
    // Route::get('notifications/mark-read', 'NotificationController@mark')->name('notification.mark');
});
