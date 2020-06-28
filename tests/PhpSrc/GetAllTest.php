<?php

namespace PHPWatch\PhpToken\Tests\PhpSrc;

use PhpToken;
use PHPUnit\Framework\TestCase;

class GetAllTest extends TestCase {

    public function testGetAll_Case1(): void {
        $code = <<<'PHP'
<?php
function foo() {
    echo "bar";
}
PHP;

        $tokens = PhpToken::getAll($code);
        $this->assertContainsOnlyInstancesOf(PhpToken::class, $tokens);

        $this->assertSame(1, $tokens[0]->line);
        $this->assertSame('function', $tokens[1]->text);
        $this->assertSame(ord('}'), $tokens[14]->id);
    }

}
