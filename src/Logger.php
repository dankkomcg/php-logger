<?php

namespace Dankkomcg\Logger;

interface Logger
{

    /**
     * @param string $message
     * @return void
     */
    public function info(string $message): void;

    /**
     * @param string $message
     * @return void
     */
    public function warning(string $message): void;

    /**
     * @param string $message
     * @return void
     */
    public function error(string $message): void;

    /**
     * @param string $message
     * @return void
     */
    public function success(string $message): void;

    /**
     * @param string $message
     * @return void
     */
    public function debug(string $message): void;

    /**
     * @param string $message
     * @param string $level
     * @return void
     */
    public function write(string $message, string $level): void;

}