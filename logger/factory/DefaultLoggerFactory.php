<?php

namespace app\logger\factory;

use app\logger\Logger;

class DefaultLoggerFactory extends LoggerFactory
{

    public function getLogger(): Logger
    {
        return new Logger();
    }
}