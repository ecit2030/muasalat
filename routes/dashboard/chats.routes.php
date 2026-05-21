<?php

use App\Http\Controllers\Dashboard\Chat\ChatController;

route_group('chat', function () {
    Route::resources([
        'chats' => 'ChatController',
    ]);

    Route::post('/reply/{chat}/{message}', [ChatController::class, "replyMessage"])
        ->name("chats.reply");

    Route::get('/chats/{chat}/messages', [ChatController::class, 'pollMessages'])
        ->name('chats.messages');

});
