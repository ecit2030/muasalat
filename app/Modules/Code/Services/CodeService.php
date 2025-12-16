<?php

namespace Modules\Code\Services;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CodeService
{
    private $verficationService;

    public function __construct()
    {
        $this->verficationService = match (config('custom.verfication_by')) {
            'email' => new EmailService(),
            'sms' => new SmsService(),
        };
    }

    public function sendCode($phone, string $model, $title, $message)
    {
        // if ($this->verficationService->CanSendAnotherCode($phone, $model)) {
        return $this->verficationService->sendVerficationCode($phone, $model, $title, $message);
        // }
        // return   throw new HttpResponseException(sendError(__('message.too_many_request'), ["time" => "should wait a minute to request this agian"]));

    }

    public function sendCodeUsingMailOrPhone($data, string $model, $title, $message)
    {
        if ($data['type'] == 'email') {
            return (new EmailService())->sendVerificationCodeUsingMail($data['email'] ?? '', $model, $title, $message);
        } else {
            return (new SmsService())->sendVerficationCode($data['phone'] ?? '', $model, $title, $message);
        }

    }

    public function verifyCode($phone, string $model, string $code, bool $deleteCode = true)
    {
        return $this->verficationService->verify($phone, $model, $code, $deleteCode);
    }

    public function verifyCodeUsingMailOrPhone($data, string $model, string $code, bool $deleteCode = true)
    {
        if ($data['type'] == 'email') {
            return (new EmailService())->verifyUsingMail($data['email'] ?? '', $model, $code, $deleteCode);
        } else {
            return (new SmsService())->verify($data['phone'] ?? '', $model, $code, $deleteCode);
        }
    }
}
