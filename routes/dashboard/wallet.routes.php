<?php

use App\Http\Controllers\Dashboard\Wallet\WalletController;


Route::name("wallet")->resource("wallet", WalletController::class);
Route::middleware("role:admin")->post("wallet/accept" , [WalletController::class , "accept"] )->name("wallet.wallet.accept");
Route::middleware("role:admin")->post("wallet/decline" , [WalletController::class , "decline"] )->name("wallet.wallet.decline");
