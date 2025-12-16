<?php

use App\Http\Controllers\Dashboard\Report\ReportController;


Route::name("report")->resource("report", ReportController::class);
