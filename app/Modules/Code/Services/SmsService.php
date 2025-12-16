<?php

namespace Modules\Code\Services;

use Modules\Code\Contract\VerficationInterface;
use Modules\Code\Entities\Code;
use App\Events\SendSmsMessageEvent;

class SmsService implements VerficationInterface
{
    public function sendVerficationCode($phone, string $model, string $title, string $message): Code
    {
        // $code_number = env('APP_ENV') == 'local' ? '1234' : \Illuminate\Support\Str::random(4);
        $code_number = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        Code::where('phone', $phone)->delete();
        $code = Code::create([
            'code'       => $code_number,
            'phone'      => $phone,
            'class_type' => $model,
        ]);
        event(new SendSmsMessageEvent($code_number , $message , $phone)) ;
        return $code;
    }

    public function verify(string $phone, string $model, string $code, bool $deleteCode = true): bool
    {
        $code = Code::where('phone', $phone)->where('class_type', $model)->where('code', $code)->latest()->first();
        if ($code) {
            if ($deleteCode) {
                Code::where('phone', $phone)->delete();
            }
            return true;
        }
        return false;
    }

    public function CanSendAnotherCode(string $phone, string $model): bool
    {
        $code = Code::where('phone', $phone)->where('class_type', $model)->where('created_at', '>', now()->subMinutes(1))->count();
        if ($code > 0) {
            return false;
        }
        return true;
    }
}
