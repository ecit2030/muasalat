<?php

use App\Http\Controllers\Dashboard\Faq\FaqController;


Route::name("faqs")->resource("faqs", FaqController::class);
