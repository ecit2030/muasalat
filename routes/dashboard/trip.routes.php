<?php

use App\Http\Controllers\Dashboard\Trip\TripController;

Route::get('trips/by-track/exporttrips',[TripController::class,'exportTrackTrips'])->name('trips.trips.exporttracktrips');
Route::get('trips/exporttrip/{trip}',[TripController::class,'exportTrip'])->name('trips.trips.exporttrip');
Route::get('trips/by-track',[TripController::class,'indexTrack'])->name('trips.trips.indextrack');
Route::get('trips/by-track/pdf',[TripController::class,'generateTrackPDF'])->name('trips.trips.trackpdf');
Route::get('trips/by-track/show/{id}',[TripController::class,'showTrack'])->name('trips.trips.showtrack');
Route::name("trips")->resource("trips", TripController::class);
