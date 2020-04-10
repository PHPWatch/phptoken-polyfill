<?php

class PhpToken implements Stringable {
    /**
     * @var int One of the T_* constants, or an integer < 256 representing a single-char token.
     */
    public $id;

    /**
     * @var string The textual content of the token.
     */
    public $text;

    /**
     * @var int The starting line number (1-based) of the token.
     */
    public $line;

    /**
     * @var int The starting position (0-based) in the tokenized string.
     */
    public $pos;

    /**
     * Same as token_get_all(), but returning array of PhpToken.
     * @return static[]
     */
    public static function getAll(string $code, int $flags = 0): array {

    }

    final public function __construct(int $id, string $text, int $line = -1, int $pos = -1) {

    }

    /**
     * Get the name of the token.
     *
     * @return string|null
     */
    public function getTokenName(): ?string {

    }


    /**
     * Whether the token has the given ID, the given text,
     * or has an ID/text part of the given array.
     *
     * @param int|string|array $kind
     *
     * @return bool
     */
    public function is($kind): bool {

    }

    /**
     * Whether this token would be ignored by the PHP parser.
     * @return bool
     */
    public function isIgnorable(): bool {

    }

    public function __toString(): string {
        return $this->text;
    }
}
