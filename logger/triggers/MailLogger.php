<?php

namespace app\logger\triggers;

use app\interfaces\LogTriggerInterface;
use Yii;

class MailLogger implements LogTriggerInterface
{
    private array $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function send(string $message): void
    {
        $message = date('Y-m-d H:i:s') . ': ' . $message;

        Yii::$app->mailer->compose()
            ->setFrom($this->options['sender'])
            ->setTo($this->options['recipient'])
            ->setSubject('Log')
            ->setHtmlBody($message)
            ->send();
    }
}