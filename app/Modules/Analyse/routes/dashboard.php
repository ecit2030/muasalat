<?php

use Illuminate\Support\Facades\Route;
use Modules\Analyse\Http\Controllers\Dashboard\AnalyseController;

// ============= Users Ajax Route ==============

Route::resource('analysis', AnalyseController::class);
Route::patch('analysis/{analyse}/trigger', [AnalyseController::class, 'trigger'])->name('analysis.trigger');
