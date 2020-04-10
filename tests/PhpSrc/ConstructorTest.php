<?php

namespace PHPWatch\PhpToken\PhpSrc;

use PhpToken;
use PHPUnit\Framework\TestCase;

class ConstructorTest extends TestCase {

  public function testConstruct_Case1(): void {
      $token = new PhpToken(300, 'function');
      $this->assertSame(300, $token->id);
      $this->assertSame('function', $token->text);
      $this->assertSame(-1, $token->line);
      $this->assertSame(-1, $token->pos);
  }

    public function testConstruct_Case2(): void {
        $token = new PhpToken(300, 'function', 10);
        $this->assertSame(300, $token->id);
        $this->assertSame('function', $token->text);
        $this->assertSame(10, $token->line);
        $this->assertSame(-1, $token->pos);
    }

    public function testConstruct_Case3(): void {
        $token = new PhpToken(300, 'function', 10, 100);
        $this->assertSame(300, $token->id);
        $this->assertSame('function', $token->text);
        $this->assertSame(10, $token->line);
        $this->assertSame(100, $token->pos);
    }
}

