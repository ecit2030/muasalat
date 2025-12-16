<?php

use App\Http\Controllers\Dashboard\Track\TrackController;


Route::name("track")->resource("track", TrackController::class);
