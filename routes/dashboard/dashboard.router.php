<?php

use App\Support\Actions\ChangeLocalizationAction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Home\HomeController;
use App\Http\Controllers\Dashboard\ContactUs\ContactUsController ;

Route::any('clear', function () {

    //Artisan::call('storage:link');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');

    //Artisan::call('telescope:clear');
    //Artisan::call('telescope:prune');

    session()->flash('success', t_('All Command successfully'));

    return redirect()->back();
})->name('clear.cache');


// CONTACT US

Route::get('lang/{locale}', [ChangeLocalizationAction::class, '__invoke'])->name('lang');
include __DIR__.'/auth.routes.php';

Route::group(['middleware' => ['auth:dashboard']], static function () {
    Route::apiResource('general/contact-us', ContactUsController::class)->only(['index', 'show'])
    ->name("show","general.contact-us.show")
    ->name("index","general.contact-us.index");

    Route::post('general/contact-us/reply', [ContactUsController::class , "reply"])->name('general.contact-us.reply');

    // Route::view('/', 'dashboard.home')->name('home');

    Route::middleware("auth:dashboard")->get('/', [HomeController::class , 'index' ])->name('home');


    require __DIR__.'/user.routes.php';
    require __DIR__.'/general.routes.php';
    require __DIR__.'/setting.routes.php';
    require __DIR__.'/organization.routes.php';
    require __DIR__.'/captain.routes.php';
    require __DIR__.'/driver.routes.php';
    require __DIR__.'/faq.routes.php';
    require __DIR__.'/track.routes.php';
    require __DIR__.'/notification.routes.php';
    require __DIR__.'/trip.routes.php';
    require __DIR__.'/wallet.routes.php';
    require __DIR__.'/report.routes.php';
    require __DIR__.'/chats.routes.php';
});
