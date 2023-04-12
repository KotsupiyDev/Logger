<?php

namespace app\logger\triggers;

use app\interfaces\LogTriggerInterface;
use app\models\Log;

class DBLogger implements LogTriggerInterface
{
    public function send(string $message = ''): void
    {
        $log = new Log();

        $log->message = $message;
        $log->date = date('Y-m-d H:i:s');

        $log->save();
    }
}