<?php

// Load Dashboard Routes

use App\Http\Controllers\FileController;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;
Route::get('/checkout/pay', function (\Illuminate\Http\Request $request){
    return view('payment-response',compact('request'));
});


Route::group(['middleware' => ['auth:dashboard']], static function () {
    $dashboard_route_glob = glob(app_path('/Modules/**/routes/dashboard.php'));
    foreach ($dashboard_route_glob as $file) {
        $str = explode('/', strtolower(substr($file, strpos($file, 'Modules'))));
        Route::group(
            ['as' => "{$str[1]}.dashboard.", 'prefix' => "{$str[1]}/dashboard/"],
            function () use ($file) {
                file_exists($file) ? include "{$file}" : '';
            }
        );
    }
});

// Load frontend Routes
$frontend_route_glob = glob(app_path('/Modules/**/routes/frontend.php'));
foreach ($frontend_route_glob as $file) {
    $str = explode('/', strtolower(substr($file, strpos($file, 'Modules'))));
    Route::group(
        ['as' => "{$str[1]}.frontend.", 'prefix' => "{$str[1]}.frontend."],
        function () use ($file) {
            file_exists($file) ? include "{$file}" : '';
        }
    );
}

//general
Route::any('/upload-file', [FileController::class, 'uploadFile'])->name('upload.file');
Route::any('/delete-file', [FileController::class, 'deleteFile'])->name('delete.file');
Route::any('/delete-file-by-uuid', [FileController::class, 'deleteFileByUUID'])->name('delete.file.by.uuid');


Route::get('wasl-api',function(Request $request){
    try{
        $identityNumber = 2476518861;
        $client = new \GuzzleHttp\Client([
            'base_uri' => config('wasl.WASL_BASE_URL'),
            'timeout' => 2.0,
            'verify' => true,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'client-id' => config('wasl.WASL_CLIENT_ID'),
                'app-id' => config('wasl.WASL_APP_ID'),
                'app-key' => config('wasl.WASL_APP_KEY'),
            ],
            'curl' => [CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2], # Set TLS version to 1.2
        ]);
        $response = $client->get(config('wasl.WASL_CHECK_DRIVER_ELIGIBLIITY_ENDPOINT') . '/' . urlencode($identityNumber));
        if ($response->getStatusCode() == 200) {
            $responseData = json_decode($response->getBody()->getContents(), true);
            return response()->json($responseData);
        }
    }
    catch (\GuzzleHttp\Exception\RequestException $e){
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $reasonPhrase = $response->getReasonPhrase();
            $body = json_decode($response->getBody()->getContents(),true);
            return response()->json(['error' => "Request failed with status code $statusCode: $reasonPhrase",'status' => $statusCode, 'body' => $body], $statusCode);
        } else {
            return response()->json(['error' => 'Request failed without a response.' . $e->getMessage(),'status' => 500 , 'body' => ''], 500);
        }
    }
});

Route::get('wasl-package',function(Request $request){
    $identityNumber = 1034120517;
//    $identityNumber = 2478855386;
    $checkResponse = \Moltaqa\Wasl\Wasl::getInstance()->driverCheckEligibility($identityNumber);
    $decodedCheckResponse = json_decode(json_encode($checkResponse->getData()),true);
//    return $decodedCheckResponse['body'];
    $rejections = extractRejectionReasons($decodedCheckResponse['body']);
    foreach ($rejections as &$rejection){
        $rejection = trans('moltaqa-wasl::messages.'.$rejection);
    }
    return $rejections;
});



Route::get('sync',function(Request $request){
    \App\Models\User::whereId(1)->first()->syncRoles(['super','mainadmin','admin']);
    \App\Models\User::whereId(2)->first()->syncRoles(['mainadmin','admin']);
    \App\Models\User::whereId(6)->first()->syncRoles(['organization']);
    \App\Models\User::whereIn('id',[3,4,5,7,8,9,10])->get()->each(function($user){
        $user->syncRoles(['captain']);
        return $user;
    });
    return "done";
});