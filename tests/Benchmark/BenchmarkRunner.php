<?php

namespace PHPWatch\PhpToken\Tests\Benchmark;

use Ayesh\PHP_Timer\Timer;
use PhpToken;

class BenchmarkRunner {
		public static function run(): void {
				$contents = file_get_contents(__DIR__ . '/../Fixtures/sample-php-file.txt');
				$class = new \ReflectionClass(PhpToken::class);

				$polyfilled = (bool) $class->getFileName();

				$stopwatch = new Timer();
				$stopwatch::start();

				for ($i = 1; $i < 100; $i++) {
						PhpToken::getAll($contents);
				}

				$stopwatch::stop();

				static::displayResults($polyfilled, $stopwatch::read('default', Timer::FORMAT_HUMAN));
		}

		private static function displayResults(bool $polyfilled, string $duration): void {
			echo "_____________________________________________________________\r\n";
			echo "                      Benchmark Complete                      \r\n";
			echo ' - Polyfilled: ' . ($polyfilled ? 'Yes' : 'No') . "\r\n";
			echo ' - Duation   : ' . $duration . " (for 100 tokenizations)\r\n";
		}
}
