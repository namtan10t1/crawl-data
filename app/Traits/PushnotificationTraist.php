<?php

namespace App\Traits;

use App\Services\ExcelService;

trait PushNotificationTrait
{
    public function addLineHandle($line = 0)
    {
        return $line += 3;
    }
}
