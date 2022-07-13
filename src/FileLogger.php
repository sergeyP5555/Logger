<?php
namespace App;

use App\LogLevel;
use App\LoggerInterface;

class FileLogger implements LoggerInterface
{
    protected $fileHandle;

    public function __construct()
    {
        try {
            $this->fileHandle = fopen($_SERVER['DOCUMENT_ROOT'] . '/logs/log.txt', 'a+');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function __destruct()
    {
        fclose($this->fileHandle);
    }

    public function log($level, $message, array $context = []): void
    {
        $date = date('Y-m-d G:i:s');
        $context = print_r($context, true);
        fwrite($this->fileHandle, "$date | $level | $message | $context \n");
    }

    public function emergency($message, array $context = []): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = []): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = []): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = []): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = []): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = []): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = []): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = []): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }
}