<?php


namespace PHPWatch\PhpToken\Tests\Cursor;


use PhpToken;
use PHPUnit\Framework\TestCase;

class UTF8Test extends TestCase {

    public function testUtf8Encoding(): void {
        // With UTF-8 encoding, each heart emoji should take 4 bytes, which PHP should count as 4 positions.
        $s = '<?php $r = "❤";$r = "❤";';
        $tokens = PhpToken::getAll($s);
        $this->assertSame(22, $tokens[11]->pos);
        $this->assertSame(27, $tokens[12]->pos);
    }

}
