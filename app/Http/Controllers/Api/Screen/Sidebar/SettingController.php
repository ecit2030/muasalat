<?php

namespace App\Http\Controllers\Api\Screen\Sidebar;

use App\Events\ChatEvent;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Screen\Sidebar\Chat\SendMessageRequest;
use App\Http\Requests\Api\Screen\Sidebar\ContactUs\ContactUsRequest;
use App\Http\Requests\Api\Screen\Sidebar\Chat\getChatRequest;
use App\Http\Resources\Api\Client\Trip\ManagementChatMessagesResource;
use App\Http\Resources\Api\Client\Trip\ManagementChatResource;
use App\Http\Resources\Api\Screen\Sidebar\Setting\FaqResource;
use App\Http\Resources\Api\Screen\Sidebar\Setting\InnerChatResource;
use App\Http\Resources\Api\Screen\Sidebar\Setting\MyNotificationResource;
use App\Http\Resources\Api\Screen\Sidebar\Setting\OuterChatResource;
use App\Models\Chat;
use App\Models\ContactUs;
use App\Models\Faq;
use App\Models\User;
use App\Models\Trip;
use App\Notifications\ChatNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingController extends ApiController
{
    public function getNotifications()
    {
        $data = auth()?->user()?->notifications?->sortByDesc(function ($notification) {
            return $notification->created_at?->timestamp;
        });

        auth()?->user()?->unreadNotifications?->markAsRead();

        $data = MyNotificationResource::collection($data);

        self::apiCode(200)
            ->apiBody(["data" => $data]);

        return self::apiResponse();
    }

    public function toggleNotifications()
    {
        $user = auth()?->user();

        $user->update([
            "is_notifiable" => !$user->is_notifiable
        ]);

        self::apiCode(200);
        self::apiMessage(t_("resource_updated_successfully"));
        return self::apiResponse();
    }

    public function contactUs(ContactUsRequest $request)
    {
        $data = ContactUs::create($request->all());

        self::apiCode(200)
            ->apiMessage(__("messages.message_sent_successfuly"))
            ->apiBody(["data" => $data]);

        return self::apiResponse();
    }

    public function Faq()
    {
        $data = getPaginates(FaqResource::collection(Faq::latest()->paginate(10)));

        self::apiCode(200)
            ->apiBody(["data" => $data]);

        return self::apiResponse();
    }

    public function emergencyNumber()
    {
        $data = [];
        foreach (setting("numbers") as $value) {
            $data[] = ["number" => $value];
        }

        self::apiCode(200)
            ->apiBody(["data" => $data]);

        return self::apiResponse();
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $chat = Chat::findOrFail($request->chat_id);

//        $chat = Chat::where(function ($q) use ($request) {
//            $q->where("sender_id", auth()->id())->where("receiver_id", $request->receiver_id);
//        })->orWhere(function ($q) use ($request) {
//            $q->where("receiver_id", auth()->id())->where("sender_id", $request->receiver_id);
//        })->first();

//        if ($chat) {
        $message = $chat->messages()->create([
            "message" => $request->message,
            "user_id" => auth()->id(),
        ]);

        event(new ChatEvent($chat->id, ManagementChatMessagesResource::make($message)));
//        } else {
//            $chat = Chat::create(["sender_id" => auth()->id(), "receiver_id" => $request->receiver_id]);
//            $chat->messages()->create([
//                "message" => $request->message,
//                "user_id" => auth()->id(),
//            ]);
//        }
        if ($chat->receiver?->id == auth()->id()) {
            $receiver = $chat->sender;
        } else {
            $receiver = $chat->receiver;
        }

        $receiver->notify(new ChatNotification($receiver->sendableTokens,
            ['ar' => __("messages.you_have_new_message", [], 'ar'),
                'en' => __("messages.you_have_new_message", [], 'en')]
            , $chat));

        return sendResponse(__("messsages.resource_created"));
    }

    public function getMessage()
    {
        $chats = Chat::query()
            ->where("sender_id", auth()->id())
            ->orWhere("receiver_id", auth()->id())
            ->has('messages')
            ->with(['messages', 'receiver', 'sender'])
            ->latest()->get();

        return sendResponse(OuterChatResource::collection($chats));
    }

    public function getChat(getChatRequest $request)
    {
        $chat = Chat::findOrFail($request->chat_id);
        $messages = $chat->messages()
            ->when($request->filled('after_id'), fn ($q) => $q->where('id', '>', $request->after_id))
            ->orderBy("created_at", "ASC")
            ->get();
        $chat->messages()->whereNull("read_at")
            ->where("user_id", "!=", auth()->id())
            ->update(["read_at" => Carbon::now()]);
        return sendResponse(InnerChatResource::collection($messages));
    }

    # ADMIN CHAT WITH CLIENT
    public function openAdminChat(Request $request)
    {
        $superAdmin = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['super']);
        })->first();
        $tripId = null;
        $recieverId = $superAdmin?->id;

        # If chat on trip
        if($request->filled('trip_id')){
            $tripId = $request->trip_id;
            $trip = Trip::findOrFail($tripId);
            if (auth()->user()?->roles()->where('name', 'captain')->exists()) {
                $recieverId = $trip->client?->id;
            }else{
                $recieverId = $trip->driver?->id;
            }
        }

        $chat = Chat::updateOrCreate([
            'trip_id' => $tripId,
            'sender_id' => auth()->id(),
            'receiver_id' => $recieverId,
        ],
        );
        $chat->messages()?->where('user_id', auth()->id())->update(['read_at' => now()]);

        return sendResponse(ManagementChatResource::make($chat));
    }

    public function sendAdminChatMessages(Chat $chat, Request $request)
    {
        $message = $chat->messages()->create([
            "message" => $request->message,
            "user_id" => auth()->id(),
        ]);

        event(new ChatEvent($chat->id, ManagementChatMessagesResource::make($message)));


        $chat->receiver?->notify(new ChatNotification($chat->receiver?->sendableTokens,
            ['ar' => __("messages.you_have_new_message", [], 'ar'),
                'en' => __("messages.you_have_new_message", [], 'en')]
            , $chat));

        return sendResponse(ManagementChatMessagesResource::make($message));
    }

    public function getAdminChatMessages(Chat $chat, Request $request)
    {
        $messages = $chat->messages()
            ->when($request->filled('after_id'), fn ($q) => $q->where('id', '>', $request->after_id))
            ->orderBy("created_at", "DESC")
            ->get();
        $chat->messages()->whereNull("read_at")
            ->where("user_id", "!=", auth()->id())
            ->update(["read_at" => Carbon::now()]);

        return sendResponse(ManagementChatMessagesResource::collection($messages));
    }
}
