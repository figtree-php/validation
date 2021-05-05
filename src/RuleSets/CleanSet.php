<?php

namespace FigTree\Validation\RuleSets;

use FigTree\Validation\Contracts\RuleInterface;

class CleanSet extends AbstractRuleSet
{
	/**
	 * Remove all characters except letters, digits and !#$%&'*+-=?^_`{|}~@.[].
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function email(): RuleInterface
	{
		return $this->factory->create(FILTER_SANITIZE_EMAIL);
	}

	/**
	 * URL-encode string, optionally strip or encode special characters.
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function encodedString(bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeLow = false, bool $encodeHigh = false): RuleInterface
	{
		$conditions = [
			FILTER_FLAG_STRIP_LOW => ($stripLow),
			FILTER_FLAG_STRIP_HIGH => ($stripHigh),
			FILTER_FLAG_STRIP_BACKTICK => ($stripBacktick),
			FILTER_FLAG_ENCODE_LOW => ($encodeLow),
			FILTER_FLAG_ENCODE_HIGH => ($encodeHigh),
		];

		$flags = $this->addFlagsIf(0, $conditions);

		return $this->factory->create(FILTER_SANITIZE_ENCODED, $flags);
	}

	/**
	 * Remove all characters except digits, +- and optionally .,eE.
	 *
	 * @param bool $allowFractions
	 * @param bool $allowThousands
	 * @param bool $allowScientific
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function decimal(bool $allowFractions = false, bool $allowThousands = false, $allowScientific = false): RuleInterface
	{
		$conditions = [
			FILTER_FLAG_ALLOW_FRACTION => ($allowFractions),
			FILTER_FLAG_ALLOW_THOUSAND => ($allowThousands),
			FILTER_FLAG_ALLOW_SCIENTIFIC => ($allowScientific),
		];

		$flags = $this->addFlagsIf(0, $conditions);

		return $this->factory->create(FILTER_SANITIZE_NUMBER_FLOAT, $flags);
	}

	/**
	 * Equivalent to calling htmlspecialchars() with ENT_QUOTES set.
	 *
	 * Like htmlspecialchars(), this filter is aware of the default_charset and
	 * if a sequence of bytes is detected that makes up an invalid character in
	 * the current character set then the entire string is rejected resulting
	 * in a 0-length string.
	 *
	 * @param bool $encodeQuotes Whether or not to encode quotes.
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function fullSpecialChars(bool $encodeQuotes = true): RuleInterface
	{
		$flags = $this->addFlagIf(0, !$encodeQuotes, FILTER_FLAG_NO_ENCODE_QUOTES);

		return $this->factory->create(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $flags);
	}

	/**
	 * Remove all characters except digits, plus and minus sign.
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function digits(): RuleInterface
	{
		return $this->factory->create(FILTER_SANITIZE_NUMBER_INT);
	}

	/**
	 * HTML-encode '"<>& and characters with ASCII value less than 32, optionally strip or encode other special characters.
	 *
	 * @param bool $stripLow
	 * @param bool $stripHigh
	 * @param bool $stripBacktick
	 * @param bool $encodeHigh
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function specialChars(bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeHigh = false): RuleInterface
	{
		$conditions = [
			FILTER_FLAG_STRIP_LOW => ($stripLow),
			FILTER_FLAG_STRIP_HIGH => ($stripHigh),
			FILTER_FLAG_STRIP_BACKTICK => ($stripBacktick),
			FILTER_FLAG_ENCODE_HIGH => ($encodeHigh),
		];

		$flags = $this->addFlagsIf(0, $conditions);

		return $this->factory->create(FILTER_SANITIZE_SPECIAL_CHARS, $flags);
	}

	/**
	 * Strip tags and HTML-encode double and single quotes, optionally strip or encode special characters.
	 *
	 * @param bool $encodeQuotes
	 * @param bool $stripLow
	 * @param bool $stripHigh
	 * @param bool $stripBacktick
	 * @param bool $encodeLow
	 * @param bool $encodeHigh
	 * @param bool $encodeAmp
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function str(bool $encodeQuotes = true, bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeLow = false, bool $encodeHigh = false, bool $encodeAmp = false): RuleInterface
	{
		$conditions = [
			FILTER_FLAG_NO_ENCODE_QUOTES => (!$encodeQuotes),
			FILTER_FLAG_STRIP_LOW => ($stripLow),
			FILTER_FLAG_STRIP_HIGH => ($stripHigh),
			FILTER_FLAG_STRIP_BACKTICK => ($stripBacktick),
			FILTER_FLAG_ENCODE_LOW => ($encodeLow),
			FILTER_FLAG_ENCODE_HIGH => ($encodeHigh),
			FILTER_FLAG_ENCODE_AMP => ($encodeAmp),
		];

		$flags = $this->addFlagsIf(0, $conditions);

		return $this->factory->create(FILTER_SANITIZE_STRING, $flags);
	}

	/**
	 * Do nothing, optionally strip or encode special characters.
	 *
	 * @param bool $stripLow
	 * @param bool $stripHigh
	 * @param bool $stripBacktick
	 * @param bool $encodeLow
	 * @param bool $encodeHigh
	 * @param bool $encodeAmp
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function unsafe(bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeLow = false, bool $encodeHigh = false, bool $encodeAmp = false): RuleInterface
	{
		$conditions = [
			FILTER_FLAG_STRIP_LOW => ($stripLow),
			FILTER_FLAG_STRIP_HIGH => ($stripHigh),
			FILTER_FLAG_STRIP_BACKTICK => ($stripBacktick),
			FILTER_FLAG_ENCODE_LOW => ($encodeLow),
			FILTER_FLAG_ENCODE_HIGH => ($encodeHigh),
			FILTER_FLAG_ENCODE_AMP => ($encodeAmp),
		];

		$flags = $this->addFlagsIf(0, $conditions);

		return $this->factory->create(FILTER_UNSAFE_RAW, $flags);
	}

	/**
	 * Remove all characters except letters, digits and
	 * $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function url(): RuleInterface
	{
		return $this->factory->create(FILTER_SANITIZE_URL);
	}

	/**
	 * Apply addslashes().
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 *
	 * @see https://www.php.net/manual/en/function.addslashes.php
	 */
	public function withSlashes(): RuleInterface
	{
		return $this->factory->create(FILTER_SANITIZE_ADD_SLASHES);
	}
}
