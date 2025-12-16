<?php

use App\Http\Controllers\Dashboard\Captain\CaptainController;
use App\Http\Controllers\Dashboard\Captain\CaptainRequestController;


Route::name("captain")->resource("captain", CaptainController::class);

Route::middleware("notActiveCaptain")->name("captain")->resource("captainRequest", CaptainRequestController::class)->except(["index"]);

Route::name("captain")->resource("captainRequest", CaptainRequestController::class);

Route::get("captain/approve/{id}" ,  [CaptainRequestController::class , "approve" ])->name("captain.captainRequest.approve");
Route::post("captain/revoke/{id}" ,  [CaptainRequestController::class , "revoke" ])->name("captain.captainRequest.revoke");
Route::get("captain/check/{id}" ,  [CaptainRequestController::class , "check" ])->name("captain.captainRequest.check");

Route::middleware("role:admin")->post('captain/activation',[ CaptainController::class , "activation"])->name("captain.activation");
