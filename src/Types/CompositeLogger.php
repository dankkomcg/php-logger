<?php

namespace Dankkomcg\Logger\Types;

use Dankkomcg\Logger\Logger;
use Dankkomcg\Logger\Traits\Writable;
use Dankkomcg\Logger\Types\Console\ConsoleLogger;

class CompositeLogger implements Logger {

    use Writable;

    /**
     * @var array
     */
    private array $loggers = [];

    /**
     * @param Logger $logger
     * @return void
     */
    public function addLogger(Logger $logger): void {
        $this->loggers[] = $logger;
    }

    protected function write(string $message, string $level): void
    {
        foreach ($this->loggers as $logger) {
            $logger->write($message, $level);
        }
    }

}