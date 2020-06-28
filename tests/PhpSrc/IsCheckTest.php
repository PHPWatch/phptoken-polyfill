<?php

namespace PHPWatch\PhpToken\Tests\PhpSrc;

use PhpToken;
use PHPUnit\Framework\TestCase;

class IsCheckTest extends TestCase {

    public function testIsCheck_Case1(): void {
        $code = <<<'PHP'
<?php
// comment
/** comment */
function foo() {
    echo "bar";
}
PHP;
        $map = [
            ['T_OPEN_TAG', true],
            ['T_COMMENT', true],
            ['T_DOC_COMMENT', true],
            ['T_WHITESPACE', true],
            ['T_FUNCTION', false],
            ['T_WHITESPACE', true],
            ['T_STRING', false],
            ['(', false],
            [')', false],
            ['T_WHITESPACE', true],
            ['{', false],
        ];
        $tokens = PhpToken::getAll($code);
        foreach ($tokens as $i => $token) {
            if (isset($map[$i])) {
                $this->assertSame(
                    $map[$i][1],
                    $token->isIgnorable(),
                    sprintf('Checking token "%s" is ignorable', $token->getTokenName())
                );
                $this->assertSame($map[$i][0], $token->getTokenName());

                $id = $map[$i][0][0] !== 'T' ? ord($map[$i][0]) : constant($map[$i][0]);
                $this->assertTrue($token->is($id));
                $this->assertTrue($token->is([T_STRING, $id]));
            }
        }
    }

}
