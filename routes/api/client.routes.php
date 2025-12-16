<?php

use App\Http\Controllers\Api\Client\TalebatSearchController;
use App\Http\Controllers\Api\Client\TripController;
use App\Http\Controllers\Api\Client\TripV2Controller;
use App\Http\Controllers\Api\Client\WalletController;
use App\Http\Controllers\Api\Screen\Sidebar\SettingController;
use Illuminate\Support\Facades\Route;


Route::name("client.")->middleware("role:user")->prefix("client")->group(function () {

    # Trips V2
    Route::apiResource("trips", TripV2Controller::class)->only(['index', 'show', 'store']);
    Route::post("trips/search/{trip}", [TripV2Controller::class, "search"]);
    Route::post("trips/send-driver-offer/{trip}/{driver}", [TripV2Controller::class, "sendDriverOffer"]);
    Route::post("trips/{trip}/rate", [TripV2Controller::class, "rateTrip"]);
    Route::post("trips/pay-trip/{trip}", [TripV2Controller::class, "payTripAfterAcceptedForCaptain"]);
    Route::post("trips/cancel-trip/{trip}", [TripV2Controller::class, "cancelTrip"]);
    Route::get("trip/settings", [TripV2Controller::class, "settings"]);
    // Trip
//    Route::apiResource("trips", TripController::class)->only(['index', 'show', 'store']);
//    Route::post("trips/search", [TripController::class, "search"]);
//    Route::post("trips/{trip}/rate", [TripController::class, "rateTrip"]);

    // Talebat
    Route::post("talebat-trips", [TalebatSearchController::class, "store"]);
    Route::get("talebat-trip-requested-drivers/{trip}", [TalebatSearchController::class, "getRequestedDrivers"]);
    Route::post("talebat-trip-accept-driver/{trip}/{user}", [TalebatSearchController::class, "acceptedDriverOnTalebatTrip"]);
    Route::post("talebat/search", [TalebatSearchController::class, "search"]);

    # Wallet
    Route::group(['prefix' => 'wallet'], function () {
        Route::get('wallet-history', [WalletController::class, 'index']);
        Route::get('wallet-balance', [WalletController::class, 'balance']);
        Route::post('charge-wallet', [WalletController::class, 'chargeWallet']);
    });

    # Chat
    Route::group(['prefix' => 'chat'], function () {
        Route::post('open-admin-chat', [SettingController::class, 'openAdminChat']);
        Route::post('send-message/{chat}', [SettingController::class, 'sendAdminChatMessages']);
        Route::get('messages/{chat}', [SettingController::class, 'getAdminChatMessages']);
    });
});

