<?php

namespace Dankkomcg\Logger\Types\Console;

class SimpleConsoleLogHandler extends ConsoleLogger {

    protected function write(string $message, string $level): void
    {
        echo "[" . strtoupper($level) . "] " . $message . "\033[0m" . PHP_EOL;
    }

}