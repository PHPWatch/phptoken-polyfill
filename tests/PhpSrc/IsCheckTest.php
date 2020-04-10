<?php


namespace PHPWatch\PhpToken\PhpSrc;


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
          [T_OPEN_TAG, true],
          [T_COMMENT, true],
          [T_DOC_COMMENT, true],
          [T_WHITESPACE, true],
          [T_FUNCTION, false],
          [T_WHITESPACE, true],
          [T_STRING, false],
        ];
        $tokens = PhpToken::getAll($code);
        foreach ($tokens as $i => $token) {
            if (isset($map[$i])) {
                if ($map[$i][1]) {
                    $this->assertTrue( $token->isIgnorable(), 'Assert that the token "%s" is ignorable = true');

                }
                else {
                    $this->assertFalse($token->isIgnorable(), 'Assert that the token "%s" is ignorable = false');
                }

                $this->assertSame($map[$i][0], $token->id, sprintf('Assert that the name of the token at position "%d" is of name "%s"', $i, $token->getTokenName()));
            }
        }
    }
}
