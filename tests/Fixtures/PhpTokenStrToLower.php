<?php

namespace PHPWatch\PhpToken\Fixtures;

class PhpTokenStrToLower extends \PhpToken {
    public $extra = 123;

    public function getLoweredText(): string {
        return strtolower($this->text);
    }
}
