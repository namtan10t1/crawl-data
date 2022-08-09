<?php

namespace App\Traits;

use App\Services\ExcelService;

trait PushNotificationTrait
{
    public function pushMessage()
    {
        $pushNotificationService = new ExcelService();

        return $pushNotificationService;
    }
}
