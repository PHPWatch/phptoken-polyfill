<?php


namespace PHPWatch\PhpToken\Tests\Cursor;


use PhpToken;
use PHPUnit\Framework\TestCase;

use function count;
use function token_get_all;

class CursorTracingTest extends TestCase {
    public function testTokenCountsAreEqual(): void {
        $snippet = $this->getSnippet();
        $tokens = PhpToken::tokenize($snippet);
        $this->assertCount(count(token_get_all($snippet)), $tokens);
        $this->assertContainsOnlyInstancesOf(PhpToken::class, $tokens);
    }

    private function getSnippet(): string {
        $code = '';
        $code .= "\n";
        $code .= "\n";
        $code .= '<?php';
        $code .= "\n";
        $code .= "\n";
        $code .= "\n";
        $code .= '$c = \'Foo\';';
        $code .= "\n";
        $code .= "\n";
        $code .= '$d = \'Bar\';';

        return $code;
    }

    public function testIndividualTokens(): void {
        $tokens = PhpToken::tokenize($this->getSnippet());

        $this->assertSame(1, $tokens[0]->line); // whitespace
        $this->assertSame(0, $tokens[0]->pos); // whitespace

        $this->assertSame(3, $tokens[1]->line); // <?php
        $this->assertSame(2, $tokens[1]->pos); // <?php

        $this->assertSame(4, $tokens[2]->line); // whitespace
        $this->assertSame(8, $tokens[2]->pos); // whitespace

        $this->assertSame(6, $tokens[3]->line); // $c
        $this->assertSame(10, $tokens[3]->pos); // $c

        $this->assertSame(6, $tokens[4]->line); // space
        $this->assertSame(12, $tokens[4]->pos); // space

        $this->assertSame(6, $tokens[5]->line); // =
        $this->assertSame(13, $tokens[5]->pos); // =

        $this->assertSame(6, $tokens[6]->line); // space
        $this->assertSame(14, $tokens[6]->pos); // space

        $this->assertSame(6, $tokens[7]->line); // 'Foo'
        $this->assertSame(15, $tokens[7]->pos); // 'Foo'
        $this->assertSame("'Foo'", $tokens[7]->text); // 'Foo'

        $this->assertSame(6, $tokens[8]->line); // Foo
        $this->assertSame(20, $tokens[8]->pos); // Foo
        $this->assertSame(';', $tokens[8]->text); // Foo

        $this->assertSame(6, $tokens[9]->line); // new line
        $this->assertSame(21, $tokens[9]->pos); // new line

        $this->assertSame(8, $tokens[10]->line); // $d
        $this->assertSame(23, $tokens[10]->pos); // $d
    }
}
