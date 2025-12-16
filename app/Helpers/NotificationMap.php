<?php

namespace App\Helpers;

use Modules\Course\Entities\Course;
use Modules\Lesson\Entities\Lesson;
use Modules\Notification\Notifications\GeneralNotification;
use Modules\Payment\Notifications\MarketerRequestedPayment;
use Modules\Payment\Notifications\ProviderRequestedPayment;
use Modules\Request\Notifications\Client\PayRequest;
use Modules\Request\Notifications\Client\YourRequestWasAccepted;
use Modules\Request\Notifications\Client\YourRequestWasCanceled;
use Modules\Request\Notifications\Client\YourRequestWasSentToProvider;
use Modules\Request\Notifications\Provider\RequestWasPaided;
use Modules\Request\Notifications\Provider\YouHaveNewRequest;

class NotificationMap
{
    public static function getMessage($notification)
    {
        return match ($notification->type) {
            YourRequestWasSentToProvider::class => self::notificationBody($notification, 'تم إرسال طلبك  لمقدم الخدمة وفي إنتظار الرد', 'YourRequestWasSentToProvider', $notification->data['request']['id']),
//            PayRequest::class => self::notificationBody($notification, 'تم قبول طلبك يرجي الذهاب للدفع الان من خلال الرابط التالي ', 'PayRequest.'.self::getRequestType($notification->data['request']), $notification->data['request']['id']),
            YourRequestWasAccepted::class => self::notificationBody($notification, 'تم قبول طلبك يرجي الذهاب للدفع الان', 'YourRequestWasAccepted.'.self::getRequestType($notification->data['request']), $notification->data['request']['id']),
            YourRequestWasCanceled::class => self::notificationBody($notification, 'تم رفض طلبك من قبل مقدم الخدمة بسبب : '.$notification->data['request']['reject_reason'], 'YourRequestWasCanceled', $notification->data['request']['id']),
            RequestWasPaided::class => self::notificationBody($notification, 'تم الدفع بنجاح للطلب رقم #'.$notification->data['request']['id'], 'RequestWasPaided', $notification->data['request']['id']),
            YouHaveNewRequest::class => self::notificationBody($notification, 'لديك طلب جديد #'.$notification->data['request']['id'], 'YouHaveNewRequest', $notification->data['request']['id']),
            ProviderRequestedPayment::class => self::notificationBody($notification, 'لديك طلب تصفية جديد #'.$notification->data['payment']['id'] ?? '', 'YouHaveNewPaymentRequest', $notification->data['payment']['id']),
            MarketerRequestedPayment::class => self::notificationBody($notification, 'لديك طلب تصفية جديد #'.$notification->data['payment']['id'] ?? '', 'YouHaveNewPaymentRequest', $notification->data['payment']['id']),
            GeneralNotification::class => self::notificationBody($notification, $notification['data'][app()->getLocale()][0] ?? 'Un Handled', $notification['data'][app()->getLocale()][1] ?? 'Un Handled', ''),
            default => self::notificationBody($notification, 'UnHandeled Notification', 'UnHandeled Notification', '')
        };
    }

    private static function notificationBody($notification, $text, $type, $objectId = null)
    {
//        $payUrl = $notification['data']['request']['payUrl']?? '';
        return [
            'id' => $notification->id,
//            'text' => $text. $payUrl,
            'text' => $text,
            'type' => $type,
            'object_id' => $objectId,
            'created_at' => $notification->created_at->format('Y-m-d H:i:s'),
        ];
    }

    private static function getRequestType($request)
    {
        return match ($request['requestable_type']) {
            Course::class => 'Course',
            Lesson::class => 'Lesson',
            default => ''
        };
    }

    public static function getRoute($notification)
    {
        return match ($notification->type) {
            ProviderRequestedPayment::class => route('admin.payments.edit', $notification->data['payment']['id']), // $notification->data['payment']['id']
            MarketerRequestedPayment::class => route('admin.payments.edit', $notification->data['payment']['id']), // $notification->data['payment']['id']
        };
    }
}
