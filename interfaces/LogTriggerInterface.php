<?php

namespace app\interfaces;

interface LogTriggerInterface
{
    public function send(string $message): void;
}