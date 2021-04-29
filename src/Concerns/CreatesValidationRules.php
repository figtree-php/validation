<?php

namespace FigTree\Validation\Concerns;

use FigTree\Validation\Contracts\RuleInterface;

trait CreatesValidationRules
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
		$flags = 0;

		if ($checkHostname) {
			$flags |= FILTER_FLAG_HOSTNAME;
		}

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
		$flags = 0;

		if ($checkUnicode) {
			$flags |= FILTER_FLAG_EMAIL_UNICODE;
		}

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
		$flags = 0;
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

		if ($allowThousands) {
			$flags |= FILTER_FLAG_ALLOW_THOUSAND;
		}

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
		$flags = 0;
		$options = [];

		if (!is_null($min)) {
			$options['min_range'] = $min;
		}

		if (!is_null($max)) {
			$options['max_range'] = $max;
		}

		if ($allowOctal) {
			$flags |= FILTER_FLAG_ALLOW_OCTAL;
		}

		if ($allowHex) {
			$flags |= FILTER_FLAG_ALLOW_HEX;
		}

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
		$flags = 0;

		if ($allowV4) {
			$flags |= FILTER_FLAG_IPV4;
		}

		if ($allowV6) {
			$flags |= FILTER_FLAG_IPV6;
		}

		if (!$allowPrivateRange) {
			$flags |= FILTER_FLAG_NO_PRIV_RANGE;
		}

		if (!$allowReservedRange) {
			$flags |= FILTER_FLAG_NO_RES_RANGE;
		}

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
}