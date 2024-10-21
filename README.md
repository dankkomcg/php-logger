# PHP Logger

![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue.svg)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://img.shields.io/badge/build-passing-brightgreen.svg)](https://github.com/dankkomcg/php-logger)

PHP Logger is a versatile logging library for PHP applications, providing multiple logging options including console and file logging. It is designed to be easily integrated into any PHP project.

## Features

- **Console Logging**: Supports color-coded console logs for better visibility.
- **File Logging**: Write logs to files using Monolog.
- **Customizable**: Easily extendable with different logging strategies.

## Installation

Install the library via Composer:

```bash
composer require dankkomcg/php-logger
```

Include the autoloader in your PHP script:

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
```

## Usage

### Basic Example

Here's a basic example demonstrating console logging:

```php
<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';

use Dankkomcg\Logger\Traits\Console\ConsoleLoggable;
use Dankkomcg\Logger\Types\Console\LightColourConsoleLogger;

$test = new class {
    use ConsoleLoggable;

    public function checkTest() {
        $this->logger()->info('write to file');
    }
};

$test->setLogger(
    new LightColourConsoleLogger(
        [
            'info' => 'red'
        ]
    )
);

$test->checkTest();
```

### File Logging

To log messages to a file, use the `MonologFileLogger`:

```php
<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';

use Dankkomcg\Logger\Traits\Console\ConsoleLoggable;
use Dankkomcg\Logger\Types\File\MonologFileLogger;

$test = new class {

    use Loggable;

    public function checkTest() {
        $this->logger()->info('write to file');
    }
};

$test->setLogger(
    new MonologFileLogger(
        dirname(__FILE__) . '/test.log', 'test'
    )
);

$test->checkTest();
```

## Available Loggers

The PHP Logger library offers various types of loggers, each suited for different logging needs. Below is a detailed description of the available logger types:

### Console Loggers

Console loggers are designed to output logs directly to the console, which is useful for development and debugging purposes.

- **ColourConsoleLogger**: This logger outputs logs with customizable colors, allowing different log levels to be easily distinguished by color coding.

- **LightColourConsoleLogger**: Similar to `ColourConsoleLogger`, but with a lighter color palette. It provides an easy way to highlight logs in environments where lighter colors are preferred.

- **ConsoleLogger**: A basic console logger that outputs plain text logs without any color formatting.

- **SimpleConsoleLogHandler**: A handler class that manages the logging process for console loggers, ensuring that logs are appropriately formatted and displayed.

### File Loggers

File loggers are used to write logs to files, which can be useful for persistent storage and later analysis.

- **MonologFileLogger**: This logger utilizes the Monolog library to write logs to files. It supports various handlers and formatters provided by Monolog, allowing for flexible and powerful file logging capabilities.

These logger types can be easily integrated into your project by setting them up as shown in the examples provided in the basic usage section. Each logger type is designed to be extensible and customizable, allowing you to tailor the logging behavior to fit your specific needs.

## Traits

The library includes several traits to enhance logging functionality and flexibility. These traits provide reusable methods that can be incorporated into your classes to streamline logging processes.

This traits apply the logger method as protected because _the logger is intended to be used within the class, not to expose it_. Please consider this when writing tests.

### Available Traits

- **ConsoleLoggable**: This trait is specifically designed for managing console log handlers. It provides methods to set and retrieve console loggers, ensuring that only compatible console loggers are used. The trait defaults to using a `SimpleConsoleLogHandler` if no logger is explicitly set.

- **Loggable**: This trait offers a general-purpose logging interface that can be integrated into any class. It simplifies the process of adding logging capabilities by providing basic methods to handle log operations.

- **Writable**: This trait focuses on file logging capabilities. It provides a simple methods to manage file loggers, allowing classes to easily write logs to files using predefined configurations.

### Console Trait Details

The `ConsoleLoggable` trait checks if a logger is set; if not, it defaults to a `SimpleConsoleLogHandler`. It ensures that only instances of `ConsoleLogger` are accepted, throwing a `ConsoleLogTypeException` if an incompatible logger is provided.

These traits are designed to be easily integrated into your existing classes, providing a flexible and efficient way to manage logging across different environments and outputs.

## Configuration

- **Console Colors**: Customize console log colors by passing an associative array with log levels as keys and color names as values.
- **File Path**: Specify the file path and name when using `MonologFileLogger`.

## Testing

To run tests, ensure you have PHPUnit installed. Execute the following command:

```bash
./vendor/bin/phpunit --testdox tests
```

## Requirements

- PHP 7.4 or later.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
