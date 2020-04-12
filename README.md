# PhpToken Polyfill

A polyfill to bring the [PHP 8.0 `PhpToken`](https://php.watch/versions/8.0/PhpToken) class to PHP 7.1 and later.

[![Latest Stable Version](https://poser.pugx.org/phpwatch/phptoken-polyfill/v/stable)](https://packagist.org/packages/phpwatch/phptoken-polyfill) [![License](https://poser.pugx.org/phpwatch/phptoken-polyfill/license)](https://github.com/PHPWatch/phptoken-polyfill)  [![CI](https://github.com/phpwatch/phptoken-polyfill/workflows/CI/badge.svg)](https://github.com/phpwatch/phptoken-polyfill/actions)  

## Synopsis
This library provides a compatible layer to bring `PhpToken` class that comes with PHP 8. It provides the full functionality of the class, but from user-land PHP code. Note that PHP 8's built-in `PhpToken` class is fast and memory-friendly because it is in C language. However, if you have a library that requires the `PhpToken` class, you can use this library to transparently bring that functionality to any PHP version 7.1 or later.

## Prerequisites

 - PHP 7.1 or later.
 - Tokenizer extension (almost always bundled)

## Installing

The simplest way would be to install using [composer](https://getcomposer.org).

```bash
composer require phpwatch/phptoken-polyfill
```

If the `PhpToken` class is not available in your system, composer autoloader will seamlessly autoload the class provided by this library to provide the same functionality.

If you cannot use Composer, try convincing whoever made that decision it is not 2012 anymore. If that doesn't work, you can manually load the classes in the `src/` directory.

## Usage

Usage is exactly the same as PHP 8 native `PhpToken` class. 

Make sure that the file is is included. If you use Composer, include its autoload file. If the `PhpToken` class is natively available, this library will not be loaded at all. If you do not use Composer autoloader, you will need to manually `require` the files in the `src` directory.

Here is an example of using `PhpToken` class. The example below should work in any PHP version from 7.1 to 8.0 and later, even the `PhpToken` is not natively available.

```php
$snippet = '<?php echo "Hello World"; ?>';
$tokens = \PhpToken::getAll($snippet);
```

## Development, tests, and contributing
Contributions are welcome. Please open an issue or send a pull-request. Please make sure to run the tests in both Linux-based platforms as Windows. Windows uses CRLF line endings, which can make tests fail if you hardcode the assertions to expect a specific position within an LF/CR-preferred platform.

Please note that tests and other deveopment dependencies are not included when you download the zip files from Github. This is to keep the library size small. You need to clone the repository or fork it to get the full source.

## Credits

@Ayesh: [Ayesh Karunaratne](https://ayesh.me).
