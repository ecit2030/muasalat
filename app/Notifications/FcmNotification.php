<?php

namespace App\Notifications;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Services\SendFCMV2;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;


class FcmNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $fcmTokens;
    public $title;
    public $message;
    public $topic;
    public $action;
    public $notifierId;
    public $modelId;

    public function __construct($fcmTokens, $title, $message, $topic = FCMTopic::DEFAULT, $action = FCMAction::NO_ACTION,$modelId = null)
    {
        $this->fcmTokens = $fcmTokens;
        $this->title = $title;
        $this->message = $message;
        $this->topic = $topic;
        $this->action = $action;
        $this->notifierId = auth()->id() ?? 0;
        $this->modelId = $modelId;
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
     * @return Kutia\Larafirebase\Messages\FirebaseMessage
     */
    public function toFirebase($notifiable)
    {
        // return (new FirebaseMessage)
        //     ->withTitle($this->title[app()->getLocale()] ?? $this->title)
        //     ->withBody($this->message[app()->getLocale()] ?? $this->message)
        //     ->withAdditionalData([
        //         'topic' => $this->topic,
        //         'action' => $this->action,
        //         'model_id' => $this->modelId,
        //     ])
        //     ->withSound("default")
        //     ->withPriority('high')
        //     ->asNotification($this->fcmTokens);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        (new SendFCMV2())
            ->sendNotification(
                title: $this->title[app()->getLocale()] ?? $this->title,
                body:$this->message[app()->getLocale()] ?? $this->message,
                anotherData: [
                    'topic' => (string)$this->topic,
                    'action' => (string)$this->action,
                    'model_id' => (string)$this->modelId,
                ],
                fcm: $this->fcmTokens
            );
            
        return [
            "notifier_id" => $this->notifierId,
            "title" => $this->title,
            "message" => $this->message,
            "data" => [
                "topic" => $this->topic,
                "action" => $this->action,
                "trip_id" => $this->modelId,
            ],
        ];
    }
}
