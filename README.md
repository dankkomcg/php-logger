# PHP Logger

![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue.svg)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://img.shields.io/badge/build-passing-brightgreen.svg)](https://github.com/dankkomcg/php-logger)

A simple and flexible logging library for PHP applications.

## Features

- Easy to use with the `Loggable` trait
- Support for console and file logging
- Extensible with custom logger implementations
- PSR-4 compliant

## Installation

Install the package via Composer:

```bash
composer require dankkomcg/php-logger
```

## Usage

### Basic Usage

```php
use Dankkomcg\Traits\Loggable;
use Dankkomcg\Logger;
use Dankkomcg\Loggers\SimpleConsoleLogHandler;

class YourClass
{
    use Loggable;

    public function __construct()
    {
        $this->setLogger(new Logger(new SimpleConsoleLogHandler()));
    }

    public function doSomething()
    {
        $this->log('Doing something...', 'info');
        // Your code here
    }
}
```

### File Logging

```php
use Dankkomcg\Logger;
use Dankkomcg\Loggers\FileLogger;

$logger = new Logger(new FileLogger('/path/to/your/logfile.log'));
$logger->log('This message will be written to the file', 'info');
```

### Multiple Loggers

```php
use Dankkomcg\Logger;
use Dankkomcg\Loggers\SimpleConsoleLogHandler;
use Dankkomcg\Loggers\FileLogger;

$logger = new Logger(new SimpleConsoleLogHandler());
$logger->addLogger(new FileLogger('/path/to/your/logfile.log'));

$logger->log('This message will be logged to both console and file', 'warning');
```

## Available Log Levels

- `debug`
- `info`
- `warning`
- `error`

## Extending the Library

You can create your own logger by implementing the `LoggerInterface`:

```php
use YourNamespace\Interfaces\LoggerInterface;

class CustomLogger implements LoggerInterface
{
    public function log(string $message, string $level = 'info'): void
    {
        // Your custom logging logic here
    }
}
```

Then use it with the `Logger` class:

```php
$logger = new Logger(new CustomLogger());
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
