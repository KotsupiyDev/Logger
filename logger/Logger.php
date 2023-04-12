<?php

namespace app\logger;

use app\interfaces\LoggerInterface;

class Logger implements LoggerInterface
{
    private string $type;
    private string $defaultType;
    private array $options;

    public function __construct()
    {
        $this->options = require __DIR__ . '/../config/logger.php';
        $this->setDefaultValue();
    }

    public function send(string $message): void
    {
        $instanceType = $this->type ?? $this->defaultType;

        $this->sendByLogger($message, $instanceType);
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        $instance = $this->options[$loggerType]['class'];
        $options = $this->options[$loggerType]['options'];

        (new $instance($options))->send($message);
    }

    public function getType(): string
    {
        return $this->type ?? $this->defaultType;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    private function setDefaultValue(): void
    {
        $this->defaultType = $this->getDefaultType();
    }

    private function getDefaultType(): string
    {
        $defaultType = array_key_first($this->options);

        foreach ($this->options as $type => $option) {
            if($option['default']) {
                return $type;
            }
        }

        return $defaultType;
    }
}