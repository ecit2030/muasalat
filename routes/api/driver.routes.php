<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Driver\TripController;

// SIDEBAR
Route::name("driver.")->middleware("role:driver")->prefix("driver")->group(function () {

    // Trip
    Route::apiResource("trips", TripController::class);
    Route::post("trips/start" ,[TripController::class , "startTrip"] );
    Route::post("trips/finish" ,[TripController::class , "finishTrip"] );
});
