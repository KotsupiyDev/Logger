<?php

use app\logger\triggers\{DBLogger, FileLogger, MailLogger};

return [
    'file' => [
        'class' => FileLogger::class,
        'default' => true,
        'options' => []
    ],
    'db' => [
        'class' => DBLogger::class,
        'default' => false,
        'options' => []
    ],
    'mail' => [
        'class' => MailLogger::class,
        'default' => false,
        'options' => [
            'recipient' => 'kotsupiy.dev@gmail.com',
            'sender' => ['logger020901@gmail.com' => 'Logger App'],
        ]
    ]
];