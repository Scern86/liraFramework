<?php

namespace Scern\Lira;
class Logger
{
    private static array $loggers = [];

    public function __construct(public readonly string $logs_path)
    {
    }

    public function add(\Monolog\Logger $logger): void
    {
        $logger_name = $logger->getName();
        if (!array_key_exists($logger_name, self::$loggers)) {
            self::$loggers[$logger_name] = $logger;
        }
    }

    public function get(string $name): ?\Monolog\Logger
    {
        return array_key_exists($name, self::$loggers) ? self::$loggers[$name] : null;
    }
}