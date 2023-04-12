<?php

namespace app\logger\factory;

use app\logger\Logger;

class DBLoggerFactory extends LoggerFactory
{

    public function getLogger(): Logger
    {
        $logger = new Logger();
        $logger->setType('db');

        return $logger;
    }
}