<?php

namespace App\Traits;

trait Fcmable
{
    public function updateFcm($fcmToken)
    {
        $this->fcm_token = $fcmToken;
        $this->save();
    }
}
