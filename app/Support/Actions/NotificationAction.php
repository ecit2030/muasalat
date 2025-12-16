<?php

namespace App\Support\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Notification;

class NotificationAction extends Notification
{
    protected ?array $data = [];

    public function __construct(?User $user = null)
    {
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
}
