<?php

namespace app\logger\triggers;

use app\interfaces\LogTriggerInterface;

class FileLogger implements LogTriggerInterface
{
    public function send(string $message = ''): void
    {
        $path = __DIR__ . '/../../runtime/custom-logs/';
        $file = 'custom.log';
        $message = date('Y-m-d H:i:s') . ': ' . $message."\n";

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        file_put_contents($path.$file, $message, FILE_APPEND);
    }
}