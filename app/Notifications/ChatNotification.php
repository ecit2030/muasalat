<?php

namespace App\Notifications;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Events\TripChatEvent;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;


class ChatNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $fcmTokens;
    public $title;
    public $chat;


    public function __construct($fcmTokens, $title, $chat)
    {
        $this->fcmTokens = $fcmTokens;
        $this->title = $title;
        $this->chat = $chat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['firebase', "database"];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $message = $this->chat->messages()->latest()->first();
        $otherPartner = auth()->id() == $this->chat->sender_id ? $this->chat->sender : $this->chat->receiver;
        $senderIsMe = auth()->id() == $message->user_id;

        $canChat = false;
        $tripId = null;
        $tripRate = 0;
        info('log', [$notifiable->id, auth()->id(), $otherPartner->id]);
        $currentTime = Carbon::now();
        $oneHourAdded = $currentTime->copy()->addHour();
        if ($notifiable->hasRole('user')) {
            $trip = Trip::whereClientId($notifiable->id)
                ->whereNotNull('start_at')
                ->whereNull('end_at')
                ->where('is_canceled', false)
                ->whereHas('driver', function (Builder $builder) use ($otherPartner) {
                    $builder->where('driver_id', $otherPartner->id);
                })
                ->first();
            if (!is_null($trip)) {
                $tripId = $trip->id;
                $tripRate = $trip->rate;
                $canChat = true;
            }
        } else {
            $trip = Trip::whereClientId($otherPartner->id)
                ->whereNotNull('start_at')
                ->whereNull('end_at')
                ->where('is_canceled', false)
                ->whereHas('driver', function (Builder $builder) use ($notifiable) {
                    $builder->where('driver_id', $notifiable->id);
                })
                ->first();
            if (!is_null($trip)) {
                $tripId = $trip->id;
                $tripRate = $trip->rate;
                $canChat = true;
            }
        }

        return [
            "notifier_id" => $otherPartner->id,
            "title" => $this->title,
            "message" => $message->message,
            "data" => [
                "chat" => $this->chat->id,
                "LastMessage" => $message->message,
                "LastMessageDate" => $message->created_at,
                "isSeen" => $message->read_at || $senderIsMe ? "true" : "false",
                "receiverId" => $otherPartner->id,
                "name" => $otherPartner->name,
                "avatar" => $otherPartner->avatar,
                "trip_id" => $tripId,
                "rate" => $tripRate,
                "topic" => FCMTopic::NEW_MESSAGE,
                "action" => FCMAction::OPEN_CHAT,
                "can_chat" => $canChat,
            ],
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return Kutia\Larafirebase\Messages\FirebaseMessage
     */
    public function toFirebase($notifiable)
    {
        $message = $this->chat->messages()->latest()->first();
        $senderIsMe = auth()->id() == $message->user_id;
        $otherPartner = auth()->id() == $this->chat->sender_id ? $this->chat->sender : $this->chat->receiver;

        $canChat = false;
        $tripId = null;
        $tripRate = 0;
        if ($notifiable->hasRole('user')) {
            $trip = Trip::whereClientId($notifiable->id)
                ->whereNotNull('start_at')
                ->whereNull('end_at')
                ->where('is_canceled', false)
                ->whereHas('driver', function (Builder $builder) use ($otherPartner) {
                    $builder->where('driver_id', $otherPartner->id);
                })
                ->first();
            if (!is_null($trip)) {
                $tripId = $trip->id;
                $tripRate = $trip->rate;
                $canChat = true;
            }
        } else {
            $trip = Trip::whereClientId($otherPartner->id)
                ->whereNotNull('start_at')
                ->whereNull('end_at')
                ->where('is_canceled', false)
                ->whereHas('driver', function (Builder $builder) use ($notifiable) {
                    $builder->where('driver_id', $notifiable->id);
                })
                ->first();
            if (!is_null($trip)) {
                $tripId = $trip->id;
                $tripRate = $trip->rate;
                $canChat = true;
            }
        }

        $data = [
            "id" => $this->chat->id,
            "LastMessage" => $message->message,
            "LastMessageDate" => $message->created_at,
            "account_send_message" => $message->user_id,
            "isSeen" => $message->read_at || $senderIsMe ? "true" : "false",
            "receiverId" => $otherPartner->id,
            "name" => $otherPartner->name,
            "avatar" => $otherPartner->avatar,
            "chat" => $this->chat->id,
            "trip_id" => $tripId,
            "rate" => $tripRate,
            "topic" => FCMTopic::NEW_MESSAGE,
            "action" => FCMAction::OPEN_CHAT,
            "can_chat" => $canChat,
        ];

        event(new TripChatEvent($data));


        return (new FirebaseMessage)
            ->withTitle($this->title[app()->getLocale()] ?? $this->title)
            ->withBody($message->message)
            ->withAdditionalData(['data' => $data])
            ->withSound("default")
            ->withPriority('high')
            ->asNotification($this->fcmTokens);
    }
}
