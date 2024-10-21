<?php

namespace Dankkomcg\Logger\Types;

use Dankkomcg\Logger\Logger;
use Dankkomcg\Logger\Traits\Writable;
use Dankkomcg\Logger\Types\Console\ConsoleLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;

class MonologFileLogger implements Logger
{

    use Writable;

    /**
     * @var MonologLogger
     */
    private MonologLogger $streamFileLogger;

    /**
     * @param string $filename
     * @param string $fileLoggerName
     */
    public function __construct(string $filename, string $fileLoggerName) {

        $this->streamFileLogger     = new MonologLogger($fileLoggerName);

        $this->streamFileLogger->pushHandler(
            new StreamHandler(
                $filename, MonologLogger::DEBUG
            )
        );

    }

    protected function write(string $message, string $level = 'info'): void
    {
        $logLevel = $this->mapLevelToMonolog($level);
        $this->streamFileLogger->log($logLevel, "[$level] $message");
    }

    /**
     * Map the library level logs names with the monolog levels identifiers
     *
     * @param string $level
     * @return int
     */
    private function mapLevelToMonolog(string $level): int {

        $map = [
            'info'    => MonologLogger::INFO,
            'success' => MonologLogger::INFO,
            'warning' => MonologLogger::WARNING,
            'error'   => MonologLogger::ERROR,
        ];

        return $map[$level] ?? MonologLogger::INFO;
    }
}