<?php

use App\Http\Controllers\Dashboard\Driver\DriverController;


Route::name("driver")->resource("driver", DriverController::class);

Route::post('driver-vehicle-model/get', [DriverController::class, 'ajaxGetModels'])->name('driver-vehicle-model.ajax.get');
Route::post('driver-vehicle-year/get', [DriverController::class, 'ajaxGetYears'])->name('driver-vehicle-year.ajax.get');


Route::middleware("role:admin|organization")
->post('driver/activation',[ DriverController::class , "activation"])->name("driver.activation");

Route::middleware("role:admin|organization")
->post('driver/veichel',[ DriverController::class , "assignVeichle"])->name("driver.assignVeichle");
