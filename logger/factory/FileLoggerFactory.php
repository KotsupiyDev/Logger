<?php

namespace app\logger\factory;

use app\logger\Logger;

class FileLoggerFactory extends LoggerFactory
{

    public function getLogger(): Logger
    {
        $logger = new Logger();
        $logger->setType('file');

        return $logger;
    }
}