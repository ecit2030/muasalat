<?php

namespace Modules\Code\Services;

use App\Events\SendSmsMessageEvent;
use App\Mail\User\ResetPasswordCode;
use Illuminate\Support\Facades\Mail;
use Modules\Code\Contract\VerficationInterface;
use Modules\Code\Emails\ActivationEmail;
use Modules\Code\Emails\CodeEmail;
use Modules\Code\Emails\RejectOrganizationRequest;
use Modules\Code\Emails\SendPassword;
use Modules\Code\Entities\Code;

class EmailService implements VerficationInterface
{
    public function activation(string $title, string $message, string $email, string $reason = "")
    {
        try {
            Mail::to($email)->send(new ActivationEmail($title, $message, $email, $reason));
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function sendRandomPassword(string $email, string $title, string $message, string $password, $mobile = null)
    {
        try {
            Mail::to($email)->send(new SendPassword($title, $message, $password, $email,$mobile));
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
        return $password;
    }


    public function sendRejectJoin(string $email, string $title, string $message)
    {
        try {
            Mail::to($email)->send(new RejectOrganizationRequest($title, $message, $email));
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function sendVerficationCode($phone, string $model, string $title, string $message): Code
    {
        // $code_number = env('APP_ENV') == 'local' ? '1234' : \Illuminate\Support\Str::random(4);
//        $code_number = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $code_number = "1111";
        Code::where('phone', $phone)->delete();
        $code = Code::create([
            'code' => $code_number,
            'phone' => $phone,
            'class_type' => $model,
        ]);
        event(new SendSmsMessageEvent($code_number, $message, $phone));
        return $code;
    }

    public function
    sendVerificationCodeUsingMail($email, string $model, string $title, string $message): Code
    {
        $code_number = "1111";
//        $code_number = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        Code::where('email', $email)?->delete();
        $code = Code::create([
            'code' => $code_number,
            'email' => $email,
            'class_type' => $model,
        ]);

        try {
            Mail::to($email)->send(new ResetPasswordCode($code_number, $title, $message));
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
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

    public function verifyUsingMail(string $email, string $model, string $code, bool $deleteCode = true): bool
    {
        $code = Code::where('email', $email)->where('class_type', $model)->where('code', $code)->latest()->first();
        if ($code) {
            if ($deleteCode) {
                Code::where('email', $email)?->delete();
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
