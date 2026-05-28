<?php

namespace Helper\Log;

class Logger
{
    private static string $logFile = __DIR__ . '/../../logs/app.log';

    public static function info(string $message, array $context = []): void
    {
        self::log('INFO', $message, $context);
    }

    public static function error(string $message, array $context = []): void
    {
        self::log('ERROR', $message, $context);
    }

    public static function warning(string $message, array $context = []): void
    {
        self::log('WARNING', $message, $context);
    }

    public static function debug(string $message, array $context = []): void
    {
        self::log('DEBUG', $message, $context);
    }

    private static function log(string $level, string $message, array $context = []): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? ' | Context: ' . json_encode($context, JSON_UNESCAPED_UNICODE) : '';
        $logLine = "[{$timestamp}] [{$level}] {$message}{$contextStr}" . PHP_EOL;

        $dir = dirname(self::$logFile);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        @file_put_contents(self::$logFile, $logLine, FILE_APPEND);
    }

    public static function getLogs(int $lines = 100): array
    {
        if (!file_exists(self::$logFile)) {
            return [];
        }

        $content = @file_get_contents(self::$logFile);
        $logLines = array_filter(explode(PHP_EOL, $content));

        return array_slice(array_reverse($logLines), 0, $lines);
    }

    public static function clear(): void
    {
        if (file_exists(self::$logFile)) {
            @file_put_contents(self::$logFile, '');
        }
    }
}
