<?php


namespace PHPWatch\PhpToken\Tests\PhpSrc;


use PHPUnit\Framework\TestCase;
use PHPWatch\PhpToken\Tests\Fixtures\PhpTokenStrToLower;

class ExtendingTest extends TestCase {

    public function testExtendedClass(): void {
        $code = <<<'PHP'
<?PHP
FUNCTION FOO() {
    ECHO "bar";
}
PHP;

        $output = '';
        foreach (PhpTokenStrToLower::getAll($code) as $token) {
            $output .= $token->getLoweredText();

            if ($token->extra !== 123) {
                echo "Missing property!\n";
            }
        }

        $this->assertSame(
            '<?php
function foo() {
    echo "bar";
}',
            $output
        );
    }

}
