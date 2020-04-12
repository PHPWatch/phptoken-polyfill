<?php


namespace PHPWatch\PhpToken\Tests\Cursor;


use PHPUnit\Framework\TestCase;

class CursorTracingTest extends TestCase {
		public function testTokenCountsAreEqual(): void {
				$snippet = $this->getSnippet();
				$tokens = \PhpToken::getAll($snippet);
				$this->assertCount(\count(\token_get_all($snippet)), $tokens);
				$this->assertContainsOnlyInstancesOf(\PhpToken::class, $tokens);
		}

		public function testIndividualTokens(): void {
				$tokens = \PhpToken::getAll($this->getSnippet());

				$this->assertSame(1, $tokens[0]->line); // whitespace
				$this->assertSame(1, $tokens[0]->pos); // whitespace

				$this->assertSame(3, $tokens[1]->line); // <?php
				$this->assertSame(1, $tokens[1]->pos); // <?php

				$this->assertSame(4, $tokens[2]->line); // whitespace
				$this->assertSame(1, $tokens[2]->pos); // whitespace

				$this->assertSame(6, $tokens[3]->line); // $c
				$this->assertSame(1, $tokens[3]->pos); // $c

				$this->assertSame(6, $tokens[4]->line); // space
				$this->assertSame(3, $tokens[4]->pos); // space

				$this->assertSame(6, $tokens[5]->line); // =
				$this->assertSame(4, $tokens[5]->pos); // =

				$this->assertSame(6, $tokens[6]->line); // space
				$this->assertSame(5, $tokens[6]->pos); // space

				$this->assertSame(6, $tokens[7]->line); // 'Foo'
				$this->assertSame(6, $tokens[7]->pos); // 'Foo'
				$this->assertSame("'Foo'", $tokens[7]->text); // 'Foo'

				$this->assertSame(6, $tokens[8]->line); // Foo
				$this->assertSame(11, $tokens[8]->pos); // Foo
				$this->assertSame(';', $tokens[8]->text); // Foo

				$this->assertSame(6, $tokens[9]->line); // new line
				$this->assertSame(12, $tokens[9]->pos); // new line

				$this->assertSame(8, $tokens[10]->line); // $d
				$this->assertSame(1, $tokens[10]->pos); // $d
		}

		private function getSnippet(): string {
				return <<<'CODE'


<?php


$c = 'Foo';

$d = 'Bar';
CODE;
		}
}
