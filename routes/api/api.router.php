<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

Route::any('cache/clear', function () {
    //Artisan::call('storage:link');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');

    /*    Artisan::call('telescope:clear');
        Artisan::call('telescope:prune');*/

    return response()->json(['message' => t_('Done')]);
})->name('clear.cache');

include __DIR__.'/screen.routes.php';
include __DIR__.'/auth.routes.php';
Route::get("card-methods", function (){
    $data = \App\Models\CardPaymentMethod::where('active',1)->select(['id','payment','active','logo'])->get();
    return sendResponse($data);
});

Route::group(['middleware' => ['auth:sanctum']], static function () {
    include __DIR__.'/driver.routes.php';
    include __DIR__.'/client.routes.php';
    include __DIR__.'/captain.routes.php';
});

Route::get('notification',function(\Illuminate\Http\Request $request){
    $user = \App\Models\User::find($request->userId ?? 27);
    $user->notify(new \App\Notifications\FcmNotification($user->sendableTokens,$request->title ?? "title",$request->message ?? "message",\App\Classes\FCMTopic::DEFAULT,\App\Classes\FCMAction::NO_ACTION));
    return response()->json(['success' => true]);
});

Route::get('wasl-api',function(Request $request){
    try{
        $identityNumber = 2476518861;
        $client = new Client([
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
    $identityNumber = 2476518861;
    return \Moltaqa\Wasl\Wasl::getInstance()->driverCheckEligibility($identityNumber);
});