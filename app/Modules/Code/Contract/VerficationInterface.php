<?php

namespace Modules\Code\Contract;

use Modules\Code\Entities\Code;

interface VerficationInterface
{
    public function sendVerficationCode(string $email, string $model, string $title, string $message): Code;

    public function verify(string $email, string $model, string $code): bool;

    public function CanSendAnotherCode(string $email, string $model): bool;
}
