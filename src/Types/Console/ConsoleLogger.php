<?php

namespace Dankkomcg\Logger\Types\Console;

use Dankkomcg\Logger\Logger;
use Dankkomcg\Logger\Traits\Writable;

abstract class ConsoleLogger implements Logger {

    use Writable;

    /**
     * @param string $message
     * @param string $level
     * @return void
     */
    abstract protected function write(string $message, string $level): void;

}