<?php

use App\Http\Controllers\Api\Captain\TrackController;
use App\Http\Controllers\Api\Captain\TripController;
use App\Http\Controllers\Api\Captain\NewTripController;
use App\Http\Controllers\Api\Captain\WalletController;
use App\Http\Controllers\Api\Captain\FrequencyTransmissionController;
use Illuminate\Support\Facades\Route;

Route::name("captain.")->middleware("role:captain")->prefix("captain")->group(function () {

    // Track
    Route::get("tracks/activation/{track}" ,[TrackController::class , "activation"] );
    Route::apiResource("tracks" , TrackController::class) ;

    // Trip
    Route::get("trips/test/index" ,[TripController::class , "testIndex"] );

    Route::apiResource("trips" , NewTripController::class) ;
    Route::post("trips/accept/{trip}" ,[NewTripController::class , "acceptTrip"] );
    Route::post("trips/reject/{trip}" ,[NewTripController::class , "rejectTrip"] );
    Route::post("trips/start" ,[NewTripController::class , "startTrip"] );
    Route::post("trips/delivered-to-client" ,[NewTripController::class , "deliveredToClient"] );
    Route::post("trips/finish" ,[NewTripController::class , "finishTrip"] );
    Route::post("trips/cancel" ,[NewTripController::class , "cancelTrip"] );
    Route::post("trips/talebat-trip-send-offer/{trip}" ,[NewTripController::class , "sendOfferOnTalebatTrip"] );
    Route::get("trips-settings" ,[NewTripController::class , "settings"] );

    // Wallet
    Route::get("wallet/page" ,[WalletController::class , "walletPage"] );
    Route::get("wallet/withdraws" ,[WalletController::class , "walletWithDraws"] );
    Route::post("wallet/withdraw/order" ,[WalletController::class , "walletWithDrawOrder"] );

    // Frequency Transmissions
    Route::get("frequency-transmissions", [FrequencyTransmissionController::class, "index"]);
    Route::patch("frequency-transmissions/{frequencyTransmission}/decide", [FrequencyTransmissionController::class, "decide"]);
});

