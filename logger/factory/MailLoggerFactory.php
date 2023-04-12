<?php

namespace app\logger\factory;

use app\logger\Logger;

class MailLoggerFactory extends LoggerFactory
{

    public function getLogger(): Logger
    {
        $logger = new Logger();
        $logger->setType('mail');

        return $logger;
    }
}