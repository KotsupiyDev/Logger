<?php

namespace app\controllers;

use app\logger\factory\DBLoggerFactory;
use app\logger\factory\DefaultLoggerFactory;
use app\logger\factory\FileLoggerFactory;
use app\logger\factory\MailLoggerFactory;
use yii\base\Security;
use yii\web\Controller;

class LoggerController extends Controller
{
    public FileLoggerFactory $fileLoggerFactory;
    public DBLoggerFactory $dbLoggersFactory;
    public MailLoggerFactory $mailLoggersFactory;
    public DefaultLoggerFactory $defaultLoggerFactory;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->fileLoggerFactory = new FileLoggerFactory();
        $this->dbLoggersFactory = new DBLoggerFactory();
        $this->mailLoggersFactory = new MailLoggerFactory();
        $this->defaultLoggerFactory = new DefaultLoggerFactory();
    }

    public function actionLog($loggersAmount = 3): string
    {
        $loggersResponse = [];

        $loggers = $this->defaultLoggerFactory->getLoggers($loggersAmount);

        foreach ($loggers as $logger) {
            $message = (new Security)->generateRandomString(30);

            $logger->send($message);

            $loggersResponse[] = $message . ': was sent via ' . $logger->getType();
        }

        return $this->render('index', ['loggersResponse' => $loggersResponse]);
    }

    public function actionLogTo(string $type, int $loggersAmount = 3)
    {
        $loggers = null;
        $loggersResponse = [];

        switch ($type) {
            case 'file':
                $loggers = $this->fileLoggerFactory->getLoggers($loggersAmount);
                break;
            case 'db':
                $loggers = $this->dbLoggersFactory->getLoggers($loggersAmount);
                break;
            case 'mail':
                $loggers = $this->mailLoggersFactory->getLoggers($loggersAmount);
                break;
        }

        foreach ($loggers as $logger) {
            $message = (new Security)->generateRandomString(30);

            $logger->send($message);
            $loggersResponse[] = $message . ': was sent via ' . $logger->getType();
        }

        return $this->render('index', ['loggersResponse' => $loggersResponse]);
    }
    /**
     * Sends a log message to all loggers. */
    public function actionLogToAll($loggersAmount = 3): string
    {
        $fileLoggers = $this->fileLoggerFactory->getLoggers($loggersAmount);
        $dbLoggers = $this->dbLoggersFactory->getLoggers($loggersAmount);
        $mailLoggers = $this->mailLoggersFactory->getLoggers($loggersAmount);
        $loggersResponse = [];

        for ($i = 0;$i < $loggersAmount; $i++) {
            $message = (new Security)->generateRandomString(30);

            $fileLoggers[$i]->send($message);
            $loggersResponse[] = $message . ': was sent via ' . $fileLoggers[$i]->getType();
            $dbLoggers[$i]->send($message);
            $loggersResponse[] = $message . ': was sent via ' . $dbLoggers[$i]->getType();
            $mailLoggers[$i]->send($message);
            $loggersResponse[] = $message . ': was sent via ' . $mailLoggers[$i]->getType();
        }

        return $this->render('index', ['loggersResponse' => $loggersResponse]);
    }
}