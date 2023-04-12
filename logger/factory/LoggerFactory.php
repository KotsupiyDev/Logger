<?php

namespace app\logger\factory;

use app\logger\Logger;

abstract class LoggerFactory
{
    abstract public function getLogger(): Logger;

    public function getLoggers(int $amount): array
    {
        $result = [];

        for ($i = 0;$i < $amount; $i++) {
            $result[] = $this->getLogger();
        }

        return $result;
    }


}