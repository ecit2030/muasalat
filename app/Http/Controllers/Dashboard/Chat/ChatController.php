<?php

namespace App\Http\Controllers\Dashboard\Chat;

use App\Datatables\Dashboard\Chat\ChatDatatable;
use App\Enums\Transaction\TransactionReasonEnum;
use App\Events\ChatEvent;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\User\UsersRequest;
use App\Http\Resources\Api\Client\Trip\ManagementChatMessagesResource;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Notifications\ChatNotification;


class ChatController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.chat.chats';

    protected string $datatable = ChatDatatable::class;
    protected string $formRequest = UsersRequest::class;

    protected string $permissions = 'user';

    protected string $model = User::class;

    public function show($id)
    {
        $model = ChatMessage::findOrFail($id);
        return view($this->routeName . '.show', compact('model'));
    }

    public function replyMessage(Request $request, $chatId, $messageId)
    {
        $chat = Chat::findOrFail($chatId);

        $chatMessage = ChatMessage::find($messageId);
        $chatMessage?->update(['read_at' => now()]);
        $message = $chat->messages()->create([
            'message' => $request->message,
            'user_id' => auth('dashboard')->id(),
        ]);

        event(new ChatEvent($chat->id,ManagementChatMessagesResource::make($message)));
        $chat->sender?->notify(new ChatNotification($chat->sender?->sendableTokens,
            ['ar' => __("messages.you_have_new_message",[],'ar') , 'en' => __("messages.you_have_new_message",[],'en')]
            , $chat));


        return response()->json(['data' => ManagementChatMessagesResource::make($message)]);
    }
}
