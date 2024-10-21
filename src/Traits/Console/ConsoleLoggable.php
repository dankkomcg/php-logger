<?php

namespace Dankkomcg\Logger\Traits\Console;

use Dankkomcg\Logger\Exceptions\ConsoleLogTypeException;
use Dankkomcg\Logger\Logger;
use Dankkomcg\Logger\Types\Console\ConsoleLogger;
use Dankkomcg\Logger\Types\Console\SimpleConsoleLogHandler;

/**
 * This trait only manages log handlers to display in console log
 */
trait ConsoleLoggable {

    private static ?Logger $logHandler = null;

    /**
     * If is not defined logger, select enableDefault as SimpleConsoleLog handler
     *
     * @return Logger
     */
    protected function logger(): Logger {

        if (!isset(self::$logHandler)) {
            self::$logHandler = new SimpleConsoleLogHandler;
        }

        return self::$logHandler;
    }

    /**
     * Set logger only accept console logger
     *
     * @param Logger $logHandler
     * @return void
     */
    public function setLogger(Logger $logHandler): void {

        if (!($logHandler instanceof ConsoleLogger)) {
            throw new ConsoleLogTypeException(
                sprintf(
                    "Log handler %s can't be defined as console logger", get_class($logHandler)
                )
            );
        }

        self::$logHandler = $logHandler;
    }

}