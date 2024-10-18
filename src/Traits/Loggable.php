<?php

namespace Dankkomcg\Logger\Traits;

use Dankkomcg\Logger\Logger;
use Dankkomcg\Logger\Types\ConsoleLogger;

trait Loggable {

    private static ?Logger $logger = null;

    /**
     * Set logger is required first to use trait
     *
     * @param Logger $logger
     * @return void
     */
    public function setLogger(Logger $logger): void {
        self::$logger = $logger;
    }

    protected function logger(): Logger
    {

        // Enable by default
        if (isset(self::$logger)) {
            self::$logger = new ConsoleLogger;
        }

        return self::$logger;
    }

}