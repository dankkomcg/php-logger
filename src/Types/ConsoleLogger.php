<?php

namespace Dankkomcg\Logger\Types;

use Dankkomcg\Logger\Logger;

class ConsoleLogger implements Logger {

    /**
     * @var array
     */
    protected array $logLevels;

    public function __construct() {
        $this->initializeDefaultConfig();
    }

    protected function initializeDefaultConfig(): void {
        $this->logLevels = [
            'info' => 'blue',
            'success' => 'green',
            'warning' => 'yellow',
            'error' => 'red',
        ];
    }

    public function write(string $message, string $level = 'info'): void
    {
        $color = $this->logLevels[$level] ?? 'white';
        $colorCode = $this->getColorCode($color);
        
        echo $colorCode . "[" . strtoupper($level) . "] " . $message . "\033[0m" . PHP_EOL;
    }

    public function info(string $message): void
    {
        $this->write($message, 'info');
    }

    public function warning(string $message): void
    {
        $this->write($message, 'warning');
    }

    public function error(string $message): void {
        $this->write($message, 'error');
    }

    public function success(string $message): void {
        $this->write($message, 'success');
    }

    public function debug(string $message): void
    {
        $this->write($message);
    }

    /**
     * @param string $color
     * @return string
     */
    protected function getColorCode(string $color): string {
        $colors = [
            'black' => "\033[30m",
            'red' => "\033[31m",
            'green' => "\033[32m",
            'yellow' => "\033[33m",
            'blue' => "\033[34m",
            'magenta' => "\033[35m",
            'cyan' => "\033[36m",
            'white' => "\033[37m",
        ];

        return $colors[$color] ?? "\033[37m";
    }
}