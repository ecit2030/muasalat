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
//     Route::group(['prefix' => 'auth'], function () {
//         Route::get('register', [AuthController::class, 'getRegister']);
//         Route::post('register', [AuthController::class, 'register']);
//         Route::post('login', [AuthController::class, 'login']);
//         Route::post('forgetPassword', [AuthController::class, 'sendCode']);
//         Route::post('verifyCode', [AuthController::class, 'verifyCode']);
//         Route::post('resetPassword', [AuthController::class, 'resetPassword']);
//         Route::group(['middleware' => ['auth:sanctum']], function () {

//             Route::post('/complete-personal', [AuthController::class, 'completeInfo']);
//             Route::post('/complete-vehicle', [AuthController::class, 'completeVehicle']);
//             Route::post('/delete-acc', [AuthController::class, 'deleteAcc']);

//             Route::get('/profile', [AuthController::class, 'profile']);
//             Route::get('/notifications', [NotificationController::class, 'index']);
//             Route::post('/editProfile', [ProfileController::class, 'editProfile']);
//             Route::post('/changePassword', [ProfileController::class, 'changePassword']);
//             Route::post('/signout', [AuthController::class, 'logout']);
//         });
//     });
// });
