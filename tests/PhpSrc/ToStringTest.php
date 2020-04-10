<?php


namespace PHPWatch\PhpToken\PhpSrc;


use PhpToken;
use PHPUnit\Framework\TestCase;

class ToStringTest extends TestCase {
    public function testImplodeAssemblesString(): void {
        $tokens = PhpToken::getAll('<?php echo "Hello ". $what;');
        $this->assertSame('<?php echo "Hello ". $what;', implode($tokens));
    }

    public function testInstanceOfStringable(): void {
        $tokens = PhpToken::getAll('<?php echo "Hello ". $what;');
        $this->assertInstanceOf(\Stringable::class, $tokens[0]);
    }

    public function testStringCase(): void {
        $tokens = PhpToken::getAll('<?php echo "Hello ". $what;');
        $this->assertSame('<?php ', $tokens[0]->__toString());
    }

    public function testToStringCall(): void {
        $tokens = PhpToken::getAll('<?php echo "Hello ". $what;');
        $this->assertSame('<?php ', $tokens[0]->__toString());
    }
}
