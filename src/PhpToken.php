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

		final public function __construct(int $id, string $text, int $line = -1, int $pos = -1) {
				$this->id   = $id;
				$this->text = $text;
				$this->line = $line;
				$this->pos  = $pos;
		}

		/**
		 * Same as token_get_all(), but returning array of PhpToken.
		 *
		 * token_get_all() does not return the line number and position of tokens.
		 * This polyfill attempts to infer the line and position by observing the
		 * last token, and counting the number of lines and bytes the last line has.
		 *
		 * @param  string  $code
		 * @param  int     $flags
		 *
		 * @return static[]
		 */
		public static function getAll(string $code, int $flags = 0): array {
				$return = [];
				$tokens = \token_get_all($code, $flags);

				foreach ($tokens as $token) {
						if (\is_array($token)) {
								$return[] = new static($token[0], $token[1], $token[2]);
								continue;
						}

						// We do not have line or position information at this point.
						$return[] = new static(\ord($token), $token);
				}

				return $return;
		}

		/**
		 * Get the name of the token.
		 *
		 * @return string|null
		 */
		public function getTokenName(): ?string {
				if ($this->id < 256) {
						return \chr($this->id);
				}

				if ('UNKNOWN' !== $name = \token_name($this->id)) {
						return $name;
				}

				return null;
		}


		/**
		 * Whether the token has the given ID, the given text,
		 * or has an ID/text part of the given array.
		 *
		 * @param  int|string|array  $kind
		 *
		 * @return bool
		 */
		public function is($kind): bool {
				if (\is_string($kind)) {
						return $this->text === $kind;
				}

				if (\is_int($kind)) {
						return $this->id === $kind;
				}

				if (!\is_array($kind)) {
						throw new TypeError('Kind must be of type int, string or array');
				}

				foreach ($kind as $singleKind) {
						if (\is_string($singleKind)) {
								if ($this->text === $singleKind) {
										return true;
								}
								continue;
						}

						if (\is_int($singleKind)) {
								if ($this->id === $singleKind) {
										return true;
								}
								continue;
						}

						throw new \TypeError(
							'Kind array must have elements of type int or string'
						);
				}

				return false;
		}

		/**
		 * Whether this token would be ignored by the PHP parser.
		 *
		 * @return bool
		 */
		public function isIgnorable(): bool {
				switch ($this->id) {
						case T_WHITESPACE:
						case T_COMMENT:
						case T_DOC_COMMENT:
						case T_OPEN_TAG:
								return true;
						default:
								return false;
				}
		}

		public function __toString(): string {
				return $this->text;
		}

}
