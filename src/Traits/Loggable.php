<?php

namespace Dankkomcg\Logger\Traits;

use Dankkomcg\Logger\Exceptions\NoLogFoundException;
use Dankkomcg\Logger\Logger;
use Dankkomcg\Logger\Types\Console\SimpleConsoleLogHandler;

trait Loggable {

    private static ?Logger $logger = null;

    /**
     * @return Logger
     * @throws NoLogFoundException
     */
    protected function logger(): Logger {

        // Enable by default
        if (!isset(self::$logger)) {
            throw new NoLogFoundException("Any log handler was defined");
        }

        return self::$logger;
    }

    /**
     * Set logger is required first to use trait
     *
     * @param Logger $logger
     * @return void
     */
    public function setLogger(Logger $logger): void {
        self::$logger = $logger;
    }

    /**
     * Enable the console log
     *
     * @return void
     */
    public function enableDefault() {
        self::$logger = new SimpleConsoleLogHandler;
    }

}