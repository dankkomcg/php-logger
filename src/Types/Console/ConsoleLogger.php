<?php

namespace Dankkomcg\Logger\Types\Console;

use Dankkomcg\Logger\Logger;
use Dankkomcg\Logger\Traits\Writable;

abstract class ConsoleLogger implements Logger {

    use Writable;

}