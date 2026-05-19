<?php

use App\Http\Controllers\Dashboard\Trip\TripController;
use App\Http\Controllers\Dashboard\Trip\FrequencytransmissionController;

Route::get('trips/by-track/exporttrips',[TripController::class,'exportTrackTrips'])->name('trips.trips.exporttracktrips');
Route::get('trips/exporttrip/{trip}',[TripController::class,'exportTrip'])->name('trips.trips.exporttrip');
Route::get('trips/by-track',[TripController::class,'indexTrack'])->name('trips.trips.indextrack');
Route::get('trips/by-track/pdf',[TripController::class,'generateTrackPDF'])->name('trips.trips.trackpdf');
Route::get('trips/by-track/show/{id}',[TripController::class,'showTrack'])->name('trips.trips.showtrack');
Route::get('trips/mashwar', [TripController::class, 'indexMashwar'])->name('trips.trips.mashwar');
Route::get('trips/monthly-subscription', [TripController::class, 'indexMonthlySubscription'])->name('trips.trips.monthly-subscription');
Route::name("trips")->resource("trips", TripController::class);


Route::name("frequencytransmissions")->resource("frequencytransmissions", FrequencytransmissionController::class);


Route::get('frequencytransmissions',[FrequencytransmissionController::class,'index'])->name('trips.frequencytransmissions.index');
Route::get('frequencytransmissions/create',[FrequencytransmissionController::class,'create'])->name('trips.frequencytransmissions.create');
Route::post('frequencytransmissions/store',[FrequencytransmissionController::class,'store'])->name('trips.frequencytransmissions.store');
Route::get('frequencytransmissions/{id}',[FrequencytransmissionController::class,'show'])->name('trips.frequencytransmissions.show');
Route::get('frequencytransmissions-trips',[FrequencytransmissionController::class,'trips'])->name('trips.frequencytransmissions.trips');
Route::delete('frequencytransmissions/{id}',[FrequencytransmissionController::class,'destroy'])->name('trips.frequencytransmissions.destroy');
Route::put('frequencytransmissions/{id}/change-driver',[FrequencytransmissionController::class, 'changeDriver'])->name('.trips.frequencytransmissions.changeDriver');

