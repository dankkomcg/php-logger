<?php

namespace Dankkomcg\Logger\Types\Console;

final class LightColourConsoleLogger extends ColourConsoleLogger {

    public function __construct(array $customColoursLogLevels = []) {

        parent::__construct($customColoursLogLevels);

        // Override the default colours values
        $this->availableColoursLogLevels = array(
            'black'   => "\033[90m",
            'red'     => "\033[91m",
            'green'   => "\033[92m",
            'yellow'  => "\033[93m",
            'blue'    => "\033[94m",
            'magenta' => "\033[95m",
            'cyan'    => "\033[96m",
            'white'   => "\033[97m",
        );

    }

}