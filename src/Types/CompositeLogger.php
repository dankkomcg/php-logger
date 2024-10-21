<?php

namespace Dankkomcg\Logger\Types;

use Dankkomcg\Logger\Logger;
use Dankkomcg\Logger\Traits\Writable;

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

    public function write(string $message, string $level): void
    {
        foreach ($this->loggers as $logger) {
            $logger->write($message, $level);
        }
    }

}