<?php

use Dankkomcg\Logger\Traits\Loggable;
use PHPUnit\Framework\TestCase;
use Dankkomcg\Logger\Traits\Console\ConsoleLoggable;
use Dankkomcg\Logger\Types\Console\LightColourConsoleLogger;
use Dankkomcg\Logger\Types\MonologFileLogger;

final class ConsoleLoggerTest extends TestCase
{
    public function testConsoleLogging(): void
    {
        $test = new class {
            use ConsoleLoggable;

            public function logInfoMessage($message)
            {
                $this->logger()->info($message);
            }
        };

        $logger = new LightColourConsoleLogger(['info' => 'red']);
        $test->setLogger($logger);

        ob_start();
        $test->logInfoMessage('Test message');
        $output = ob_get_clean();

        $this->assertStringContainsString('Test message', $output);
    }
}