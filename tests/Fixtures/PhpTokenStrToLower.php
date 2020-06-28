<?php

namespace PHPWatch\PhpToken\Tests\Fixtures;

use PhpToken;

class PhpTokenStrToLower extends PhpToken {

    public $extra = 123;

    public function getLoweredText(): string {
        return strtolower($this->text);
    }

}
