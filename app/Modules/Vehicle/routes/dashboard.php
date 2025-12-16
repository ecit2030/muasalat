<?php

use Illuminate\Support\Facades\Route;
use Modules\Vehicle\Http\Controllers\Dashboard\UserVehicleController;
use Modules\Vehicle\Http\Controllers\Dashboard\VehicleBrandController;
use Modules\Vehicle\Http\Controllers\Dashboard\VehicleModelController;
use Modules\Vehicle\Http\Controllers\Dashboard\VehicleYearController;
use Modules\Vehicle\Http\Controllers\Dashboard\VehicleRequestController;

// ============= Users Ajax Route ==============

Route::resource('vehicle-brand', VehicleBrandController::class);
Route::post('vehicle-model/get', [VehicleBrandController::class, 'ajaxGetModels'])->name('dashboard.vehicle-model.ajax.get');

Route::resource('vehicle-model', VehicleModelController::class);
Route::post('vehicle-year/get', [VehicleModelController::class, 'ajaxGetYears'])->name('dashboard.vehicle-year.ajax.get');

Route::resource('vehicle-year', VehicleYearController::class);

Route::resource('vehicle-request', VehicleRequestController::class);

Route::resource('user-vehicle', UserVehicleController::class);
Route::post('user-vehicle-model/get', [UserVehicleController::class, 'ajaxGetModels'])->name('dashboard.user-vehicle-model.ajax.get');
Route::post('user-vehicle-year/get', [UserVehicleController::class, 'ajaxGetYears'])->name('dashboard.user-vehicle-year.ajax.get');
