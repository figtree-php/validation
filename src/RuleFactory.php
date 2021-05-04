<?php

namespace FigTree\Validation;

use Closure;
use FigTree\Validation\Contracts\RuleInterface;

class RuleFactory extends AbstractRuleFactory
{
	/**
	 * Create a Rule for a valid boolean.
	 *
	 * @param mixed $default
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function validBool($default = null): RuleInterface
	{
		return $this->applyDefault($this->create(FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE), $default);
	}

	/**
	 * Create a Rule for a valid domain name.
	 *
	 * @param boolean $checkHostname Adds ability to specifically validate hostnames (they must start with an alphanumeric character and contain only alphanumerics or hyphens).
	 * @param mixed $default
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function validDomain(bool $checkHostname = false, $default = null): RuleInterface
	{
		$flags = $this->addFlagIf(0, $checkHostname, FILTER_FLAG_HOSTNAME);

		return $this->applyDefault($this->create(FILTER_VALIDATE_DOMAIN, $flags), $default);
	}

	/**
	 * Create a Rule for a valid e-mail address.
	 *
	 * @param boolean $checkUnicode
	 * @param mixed $default
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function validEmail(bool $checkUnicode = false, $default = null): RuleInterface
	{
		$flags = $this->addFlagIf(0, $checkUnicode, FILTER_FLAG_EMAIL_UNICODE);

		return $this->applyDefault($this->create(FILTER_VALIDATE_EMAIL, $flags), $default);
	}

	/**
	 * Create a Rule for a valid floating-point value.
	 *
	 * @param float|null $min
	 * @param float|null $max
	 * @param integer|null $decimals
	 * @param boolean $allowThousands Allow thousand separators (commas).
	 * @param mixed $default
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function validFloat(?float $min = null, ?float $max = null, ?int $decimals = null, bool $allowThousands = false, $default = null): RuleInterface
	{
		$options = [];

		if (!is_null($min)) {
			$options['min_range'] = $min;
		}

		if (!is_null($max)) {
			$options['max_range'] = $max;
		}

		if (!is_null($decimals)) {
			$options['decimal'] = $decimals;
		}

		$flags = $this->addFlagIf(0, $allowThousands, FILTER_FLAG_ALLOW_THOUSAND);

		return $this->applyDefault($this->create(FILTER_VALIDATE_FLOAT, $flags, $options), $default);
	}

	/**
	 * Create a Rule for a valid integer.
	 *
	 * @param integer|null $min
	 * @param integer|null $max
	 * @param boolean $allowOctal
	 * @param boolean $allowHex
	 * @param mixed $default
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function validInt(?int $min = null, ?int $max = null, bool $allowOctal = false, bool $allowHex = false, $default = null): RuleInterface
	{
		$options = [];

		if (!is_null($min)) {
			$options['min_range'] = $min;
		}

		if (!is_null($max)) {
			$options['max_range'] = $max;
		}

		$conditions = [
			FILTER_FLAG_ALLOW_OCTAL => ($allowOctal),
			FILTER_FLAG_ALLOW_HEX => ($allowHex),
		];

		$flags = $this->addFlagsIf(0, $conditions);

		return $this->applyDefault($this->create(FILTER_VALIDATE_INT, $flags, $options), $default);
	}

	/**
	 * Create a Rule for a valid IP address.
	 *
	 * @param boolean $allowV4
	 * @param boolean $allowV6
	 * @param boolean $allowPrivateRange Allow IP addresses within private ranges.
	 * @param boolean $allowReservedRange Allow IP addresses within other reserved ranges.
	 * @param mixed $default
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 *
	 * @see https://en.wikipedia.org/wiki/Reserved_IP_addresses
	 */
	public function validIpAddress(bool $allowV4 = false, bool $allowV6 = false, bool $allowPrivateRange = true, bool $allowReservedRange = true, $default = null): RuleInterface
	{
		$conditions = [
			FILTER_FLAG_IPV4 => ($allowV4),
			FILTER_FLAG_IPV6 => ($allowV6),
			FILTER_FLAG_NO_PRIV_RANGE => (!$allowPrivateRange),
			FILTER_FLAG_NO_RES_RANGE => (!$allowReservedRange),
		];

		$flags = $this->addFlagsIf(0, $conditions);

		return $this->applyDefault($this->create(FILTER_VALIDATE_IP, $flags), $default);
	}

	/**
	 * Create a Rule for a valid MAC address.
	 *
	 * @param mixed $default
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function validMacAddress($default = null): RuleInterface
	{
		return $this->applyDefault($this->create(FILTER_VALIDATE_MAC), $default);
	}

	/**
	 * Create a Rule for a valid regular expression match.
	 *
	 * @param string $regex
	 * @param mixed $default
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function validRegExp(string $regex, $default = null): RuleInterface
	{
		$options = [
			'regexp' => $regex,
		];

		return $this->applyDefault($this->create(FILTER_VALIDATE_REGEXP, 0, $options), $default);
	}

	/**
	 * Apply default option to the Rule.
	 *
	 * @param \FigTree\Validation\Contracts\RuleInterface $rule
	 * @param mixed $default
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	protected function applyDefault(RuleInterface $rule, $default = null): RuleInterface
	{
		if (!is_null($default)) {
			$rule->setOption('default', $default);
		}

		return $rule;
	}

	/**
	 * Apply addslashes().
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 *
	 * @see https://www.php.net/manual/en/function.addslashes.php
	 */
	public function addSlashes(): RuleInterface
	{
		return $this->create(FILTER_SANITIZE_ADD_SLASHES);
	}

	/**
	 * Remove all characters except letters, digits and !#$%&'*+-=?^_`{|}~@.[].
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function cleanEmail(): RuleInterface
	{
		return $this->create(FILTER_SANITIZE_EMAIL);
	}

	/**
	 * URL-encode string, optionally strip or encode special characters.
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function cleanEncodedString(bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeLow = false, bool $encodeHigh = false): RuleInterface
	{
		$conditions = [
			FILTER_FLAG_STRIP_LOW => ($stripLow),
			FILTER_FLAG_STRIP_HIGH => ($stripHigh),
			FILTER_FLAG_STRIP_BACKTICK => ($stripBacktick),
			FILTER_FLAG_ENCODE_LOW => ($encodeLow),
			FILTER_FLAG_ENCODE_HIGH => ($encodeHigh),
		];

		$flags = $this->addFlagsIf(0, $conditions);

		return $this->create(FILTER_SANITIZE_ENCODED, $flags);
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
	public function cleanFloat(bool $allowFractions = false, bool $allowThousands = false, $allowScientific = false): RuleInterface
	{
		$conditions = [
			FILTER_FLAG_ALLOW_FRACTION => ($allowFractions),
			FILTER_FLAG_ALLOW_THOUSAND => ($allowThousands),
			FILTER_FLAG_ALLOW_SCIENTIFIC => ($allowScientific),
		];

		$flags = $this->addFlagsIf(0, $conditions);

		return $this->create(FILTER_SANITIZE_NUMBER_FLOAT, $flags);
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
	public function cleanFullSpecialChars(bool $encodeQuotes = true): RuleInterface
	{
		$flags = $this->addFlagIf(0, !$encodeQuotes, FILTER_FLAG_NO_ENCODE_QUOTES);

		return $this->create(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $flags);
	}

	/**
	 * Remove all characters except digits, plus and minus sign.
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function cleanInt(): RuleInterface
	{
		return $this->create(FILTER_SANITIZE_NUMBER_INT);
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
	public function cleanSpecialChars(bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeHigh = false): RuleInterface
	{
		$conditions = [
			FILTER_FLAG_STRIP_LOW => ($stripLow),
			FILTER_FLAG_STRIP_HIGH => ($stripHigh),
			FILTER_FLAG_STRIP_BACKTICK => ($stripBacktick),
			FILTER_FLAG_ENCODE_HIGH => ($encodeHigh),
		];

		$flags = $this->addFlagsIf(0, $conditions);

		return $this->create(FILTER_SANITIZE_SPECIAL_CHARS, $flags);
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
	public function cleanString(bool $encodeQuotes = true, bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeLow = false, bool $encodeHigh = false, bool $encodeAmp = false): RuleInterface
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

		return $this->create(FILTER_SANITIZE_STRING, $flags);
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
	public function cleanUnsafe(bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeLow = false, bool $encodeHigh = false, bool $encodeAmp = false): RuleInterface
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

		return $this->create(FILTER_UNSAFE_RAW, $flags);
	}

	/**
	 * Remove all characters except letters, digits and
	 * $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function cleanUrl(): RuleInterface
	{
		return $this->create(FILTER_SANITIZE_URL);
	}

	/**
	 * Create a Rule for a valid boolean.
	 *
	 * @param callable $callback
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function withCallable(callable $callback): RuleInterface
	{
		return $this->create(FILTER_CALLBACK)
			->setCallback(Closure::fromCallable($callback));
	}

	/**
	 * Create a Rule for a valid boolean.
	 *
	 * @param \Closure $callback
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function withClosure(Closure $callback): RuleInterface
	{
		return $this->create(FILTER_CALLBACK)
			->setCallback($callback);
	}

	/**
	 * Add a flag if the given condition is true.
	 *
	 * @param int $flags The flags being modified.
	 * @param bool $condition The condition being checked.
	 * @param int $flag The flag being added.
	 *
	 * @return int
	 */
	protected function addFlagIf(int $flags, bool $condition, int $flag): int
	{
		if ($condition) {
			$flags |= $flag;
		}

		return $flags;
	}


	/**
	 * Add a set of flags if their given conditions are true.
	 *
	 * @param int $flags The flags being modified.
	 * @param array $flagConditions An array of flags and their conditions to determine if they should be added.
	 *
	 * @return int
	 */
	protected function addFlagsIf(int $flags, array $flagConditions): int
	{
		foreach ($flagConditions as $flag => $condition) {
			if (is_int($flag) && is_bool($condition)) {
				$flags = $this->addFlagIf($flags, $condition, $flag);
			}
		}

		return $flags;
	}
}
