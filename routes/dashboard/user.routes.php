<?php

use App\Http\Controllers\Dashboard\User\UserController;
use Illuminate\Support\Facades\Route;

route_group('user', function () {
    Route::resources([
        'users' => 'UserController',
    ]);

    Route::middleware("role:admin")
        ->post('/activation', [UserController::class, "activation"])
        ->name("user.activation");

    Route::middleware("role:admin")
        ->get('/user/balance', [UserController::class, "getUserBalance"])
        ->name("user.get.balance");

    Route::middleware("role:admin")
        ->post('/user/balance/update', [UserController::class, "updateUserBalance"])
        ->name("user.update.balance");

});
