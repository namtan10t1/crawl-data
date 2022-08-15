<?php

namespace App\Traits;

trait Shareable
{
    public function share($line = 0)
    {
        echo $line;
        return $line += 3;

    }
}
