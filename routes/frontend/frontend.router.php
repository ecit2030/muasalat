<?php

use App\Http\Controllers\Frontend\Home\HomeController;
use Symfony\Component\Console\Output\BufferedOutput;


Route::get('/admin', [HomeController::class, 'index'])->name('home');

Route::get('/client/trip/get-details-pdf/{trip}/{lang}', [\App\Http\Controllers\Api\Client\TripV2Controller::class, 'generatePdf'])
    ->name('client.get-details-pdf');


Route::get('landing/register/org', [HomeController::class, 'getOrg'])->name("getOrg");
Route::post('landing/register/org', [HomeController::class, 'postOrg'])->name("postOrg");

Route::get('/aaa', function () {
    $output = new BufferedOutput();
    // Artisan::call('route:list', ['--json' => true], $output);
    // file_put_contents('routes.json', $output->fetch());
    // dd($output->fe   tch());

    Artisan::call('insights', ['--format' => 'json'], $output);
    dd($output->fetch());
    return $output->fetch();
});

Route::get('/', [HomeController::class, 'landing'])->name('home');
Route::post('/', [HomeController::class, 'contactUsLanding'])->name("contactUsLanding");
