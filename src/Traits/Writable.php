<?php

namespace Dankkomcg\Logger\Traits;

/**
 * Use this trait when logger available methods hasn't complex
 */
trait Writable {

    /**
     * @param string $message
     * @return void
     */
    public function info(string $message): void {
        $this->write($message, 'info');
    }

    /**
     * @param string $message
     * @return void
     */
    public function warning(string $message): void
    {
        $this->write($message, 'warning');
    }

    /**
     * @param string $message
     * @return void
     */
    public function error(string $message): void
    {
        $this->write($message, 'error');
    }

    /**
     * @param string $message
     * @return void
     */
    public function success(string $message): void
    {
        $this->write($message, 'success');
    }

    /**
     * @param string $message
     * @return void
     */
    public function debug(string $message): void
    {
        $this->write($message, 'debug');
    }

}