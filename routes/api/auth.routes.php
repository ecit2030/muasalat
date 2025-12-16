<?php

use Modules\Student\Http\Controllers\Api\AuthController;
use Modules\Student\Http\Controllers\Api\NotificationController;
use Modules\Student\Http\Controllers\Api\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|------------------------------------------- -------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group(['prefix' => 'api'], function () {
Route::group(['prefix' => 'auth'], function () {
    Route::get('register', [AuthController::class, 'getRegister']);
    Route::get('letters', [AuthController::class, 'letters']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgetPassword', [AuthController::class, 'sendCode']);
    Route::post('verifyCode', [AuthController::class, 'verifyCode']);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('resetPassword', [AuthController::class, 'resetPassword']);

        Route::middleware("role:captain")->post('/complete-personal', [AuthController::class, 'completeInfo']);
        Route::middleware("role:captain")->post('/complete-vehicle', [AuthController::class, 'completeVehicle']);
        Route::post('/delete-acc', [AuthController::class, 'deleteAcc']);

        Route::post('/firebase', [AuthController::class, 'firebase']);

        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('captain/update-location', [AuthController::class, 'updateLocation']);

        Route::get('/notifications', [NotificationController::class, 'index']);

        Route::post('/edit-profile', [ProfileController::class, 'editProfile']);
        Route::delete('/remove-image', [ProfileController::class, 'removeImage']);
        Route::middleware("role:captain")->post('/change-price', [ProfileController::class, 'changePrice']);
        Route::middleware("role:captain")->get('/change-price', [ProfileController::class, 'priceRange']);

        Route::post('/change-phone', [ProfileController::class, 'changePhone']);
        Route::middleware("role:captain")->post('toggle-activation', [ProfileController::class, 'toggleActivation']);
        Route::post('verifyChangePhoneCode', [AuthController::class, 'verifyChangePhoneCode']);
        Route::post('/changePassword', [ProfileController::class, 'changePassword']);

        Route::post('/signout', [AuthController::class, 'logout']);
    });
});
// });
