<?php

namespace App\Support\Actions;

use App\Models\User;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FCMAction
{
    protected ?array $firebaseTokens = [];

    protected ?string $messageType = 'default';

    protected ?string $topic = 'topic';

    protected ?Messaging $messaging;

    protected ?array $data = ['fcmData' => 'Start data'];

    private ?string $title = '';

    private ?string $body = '';

    private ?string $imageUrl = '';

    public function __construct(?User $user = null)
    {
        $this->messaging = app('firebase.messaging');
        $this->firebaseTokens = $user?->deviceTokens()?->pluck('token')->toArray() ?? [];
    }

    public static function new($type): self
    {
        return new self();
    }

    public function data(array $array): static
    {
        foreach ($array as $k => $v) {
            $this->data[$k] = $v;
        }

        return $this;
    }

    public function withMessageType(string $messageType): static
    {
        $this->messageType = $messageType;

        return $this;
    }

    public function withTopic(string $topic): static
    {
        $this->topic = $topic;

        return $this;
    }

    public function withClickAction(string $clickAction): static
    {
        $this->clickAction = $clickAction;

        return $this;
    }

    public function withImageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function withTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function withBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function sendMessage($type = 'topic')
    {
        $message = $this->createMessage()->withHighestPossiblePriority()->withApnsConfig([
            'payload' => [
                'aps' => [
                    'sound' => 'note.mp3',
                ],
            ],
        ])->withAndroidConfig([
            'notification' => [
                'sound' => 'note.mp3',
            ],
        ]);

        if ($type === 'tokens') {
            if (! empty($this->firebaseTokens)) {
                $this->messaging->sendMulticast($message, $this->firebaseTokens);
            }
        }

        if ($type === 'topic') {
            $this->messaging->send($message);
        }
    }

    private function createMessage()
    {
        return CloudMessage::withTarget('topic', 'topic')
            ->withNotification(Notification::create($this->title, $this->body, $this->imageUrl))
            ->withData($this->data);
    }
}
