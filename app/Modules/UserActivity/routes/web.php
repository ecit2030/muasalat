<?php
Route::group([
    'namespace' => '\Modules\UserActivity\App\Controllers',
    'middleware' => config('user-activity.middleware'),
], function (): void {
    Route::get(config('user-activity.route_path'), 'ActivityController@getIndex');
    Route::post(config('user-activity.route_path'), 'ActivityController@handlePostRequest');
});
