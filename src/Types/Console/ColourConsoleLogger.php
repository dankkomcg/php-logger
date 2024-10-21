<?php

namespace Dankkomcg\Logger\Types\Console;

use Dankkomcg\Logger\Exceptions\IncorrectColourValuesException;
use Dankkomcg\Logger\Exceptions\OneConsoleColourIsNotDefinedException;

class ColourConsoleLogger extends ConsoleLogger {

    /**
     * @var array
     */
    private array $availableLogLevels;

    /**
     * @var array
     */
    protected array $availableColoursLogLevels;

    /**
     * @param array $customColoursLogLevels
     * @throws IncorrectColourValuesException
     * @throws OneConsoleColourIsNotDefinedException
     */
    public function __construct(array $customColoursLogLevels = []) {

        $this->initializeColourLogLevels();
        $this->initializeLogLevels($customColoursLogLevels);

    }

    /**
     * Set available colours levels
     *
     * @return void
     */
    private function initializeColourLogLevels(): void {

        $this->availableColoursLogLevels = [
            'black'         => "\033[30m",
            'red'           => "\033[31m",
            'green'         => "\033[32m",
            'yellow'        => "\033[33m",
            'blue'          => "\033[34m",
            'magenta'       => "\033[35m",
            'cyan'          => "\033[36m",
            'white'         => "\033[37m"
        ];

    }

    /**
     * @param array $customLogLevelColors
     * @return void
     * @throws IncorrectColourValuesException
     * @throws OneConsoleColourIsNotDefinedException
     */
    private function initializeLogLevels(array $customLogLevelColors = []): void
    {

        $this->availableLogLevels = [
            'info'    => 'blue',
            'success' => 'green',
            'warning' => 'yellow',
            'error'   => 'red',
            'debug'   => 'white'
        ];

        // Check if log levels are defined
        $this->checkIfLogLevelsAreDefined($customLogLevelColors);

        // Check if colours levels are defined
        $this->checkIfColoursLogLevelsExists($customLogLevelColors);

        // Merge the result to required define already defined log values
        $this->availableLogLevels = array_merge(
            $this->availableLogLevels, $customLogLevelColors
        );

    }

    /**
     * @param array $customLogLevelColors
     * @return void
     * @throws IncorrectColourValuesException
     */
    private function checkIfLogLevelsAreDefined(array $customLogLevelColors): void
    {
        if (!empty($customLogLevelColors)) {

            $arrayKeysLogLevels = array_keys($customLogLevelColors);

            if ($arrayDiff = array_diff($arrayKeysLogLevels, array_keys($this->availableLogLevels))) {
                throw new IncorrectColourValuesException(
                    sprintf(
                        "Your log levels has more values than accepted: %s values.", count($arrayDiff)
                    )
                );
            }
        }
    }

    /**
     * Check if colours to assign to the log levels are available
     *
     * @param array $customLogLevelColors
     * @return void
     * @throws OneConsoleColourIsNotDefinedException
     */
    private function checkIfColoursLogLevelsExists(array $customLogLevelColors): void
    {
        if (!empty($customLogLevelColors)) {

            $arrayValuesColoursLogLevels = array_values($customLogLevelColors);

            if ($coloursArrayDiff = array_diff($arrayValuesColoursLogLevels, array_keys($this->availableColoursLogLevels))) {

                $this->checkIfOnlyOneColourIsNoAvailable($coloursArrayDiff);

                // If more than specific value is not defined, launch default message
                throw new \InvalidArgumentException(
                    sprintf(
                        "%s colours that you indicates are not defined on available log colours", count($coloursArrayDiff)
                    )
                );

            }
        }
    }

    /**
     * Checks if only one colour is not defined to specify the info to the client
     *
     * @param array $coloursArrayDiff
     * @return void
     * @throws OneConsoleColourIsNotDefinedException
     */
    private function checkIfOnlyOneColourIsNoAvailable(array $coloursArrayDiff): void
    {
        if (count($coloursArrayDiff) == 1) {
            if ($affectedColour = array_shift($coloursArrayDiff)) {
                throw new OneConsoleColourIsNotDefinedException(
                    sprintf(
                        "%s is not defined at available log colours", $affectedColour
                    )
                );
            }
        }
    }


    /**
     * @param string $message
     * @param string $level
     * @return void
     */
    protected function write(string $message, string $level): void
    {
        $color = $this->availableLogLevels[$level] ?? 'white';
        $colorCode = $this->getColorCode($color);

        echo $colorCode . "[" . strtoupper($level) . "] " . $message . "\033[0m" . PHP_EOL;
    }

    /**
     * @param string $color
     * @return string
     */
    protected function getColorCode(string $color): string {
        return $this->availableColoursLogLevels[$color] ?? "\033[37m";
    }
}