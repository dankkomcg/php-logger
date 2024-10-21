<?php

use Dankkomcg\Logger\Traits\Loggable;
use PHPUnit\Framework\TestCase;
use Dankkomcg\Logger\Traits\Console\ConsoleLoggable;
use Dankkomcg\Logger\Types\Console\LightColourConsoleLogger;
use Dankkomcg\Logger\Types\MonologFileLogger;

final class FileLoggerTest extends TestCase {

    public function testFileLogging(): void
    {
        $filePath = dirname(__FILE__) . '/test.log';

        $test = new class {

            use Loggable;

            public function logInfoMessage($message)
            {
                $this->logger()->info($message);
            }
        };

        $test->setLogger(
            new MonologFileLogger($filePath, 'test')
        );

        $test->logInfoMessage('File log message');

        $this->assertFileExists($filePath);
        $this->assertStringContainsString('File log message', file_get_contents($filePath));

        unlink($filePath);
    }

}