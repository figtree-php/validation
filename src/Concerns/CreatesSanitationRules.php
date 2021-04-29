<?php

namespace FigTree\Validation\Concerns;

use FigTree\Validation\Contracts\RuleInterface;

trait CreatesSanitationRules
{
	public function addSlashes(): RuleInterface
	{
		return $this->create(FILTER_SANITIZE_ADD_SLASHES);
	}

	public function cleanEmail(): RuleInterface
	{
		return $this->create(FILTER_SANITIZE_EMAIL);
	}

	public function cleanEncodedString(bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeLow = false, bool $encodeHigh = false): RuleInterface
	{
		$flags = 0;

		if ($stripLow) {
			$flags |= FILTER_FLAG_STRIP_LOW;
		}

		if ($stripHigh) {
			$flags |= FILTER_FLAG_STRIP_HIGH;
		}

		if ($stripBacktick) {
			$flags |= FILTER_FLAG_STRIP_BACKTICK;
		}

		if ($encodeLow) {
			$flags |= FILTER_FLAG_ENCODE_LOW;
		}

		if ($encodeHigh) {
			$flags |= FILTER_FLAG_ENCODE_HIGH;
		}

		return $this->create(FILTER_SANITIZE_ENCODED, $flags);
	}

	public function cleanFloat(bool $allowFractions = false, bool $allowThousands = false, $allowScientific = false): RuleInterface
	{
		$flags = 0;

		if ($allowFractions) {
			$flags |= FILTER_FLAG_ALLOW_FRACTION;
		}

		if ($allowThousands) {
			$flags |= FILTER_FLAG_ALLOW_THOUSAND;
		}

		if ($allowScientific) {
			$flags |= FILTER_FLAG_ALLOW_SCIENTIFIC;
		}

		return $this->create(FILTER_SANITIZE_NUMBER_FLOAT, $flags);
	}

	public function cleanFullSpecialChars(bool $encodeQuotes = true): RuleInterface
	{
		$flags = 0;

		if (!$encodeQuotes) {
			$flags |= FILTER_FLAG_NO_ENCODE_QUOTES;
		}

		return $this->create(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $flags);
	}

	public function cleanInt(): RuleInterface
	{
		return $this->create(FILTER_SANITIZE_NUMBER_INT);
	}

	public function cleanSpecialChars(bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeHigh = false): RuleInterface
	{
		$flags = 0;

		if ($stripLow) {
			$flags |= FILTER_FLAG_STRIP_LOW;
		}

		if ($stripHigh) {
			$flags |= FILTER_FLAG_STRIP_HIGH;
		}

		if ($stripBacktick) {
			$flags |= FILTER_FLAG_STRIP_BACKTICK;
		}

		if ($encodeHigh) {
			$flags |= FILTER_FLAG_ENCODE_HIGH;
		}

		return $this->create(FILTER_SANITIZE_SPECIAL_CHARS, $flags);
	}

	public function cleanString(bool $encodeQuotes = true, bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeLow = false, bool $encodeHigh = false, bool $encodeAmp = false): RuleInterface
	{
		$flags = 0;

		if (!$encodeQuotes) {
			$flags |= FILTER_FLAG_NO_ENCODE_QUOTES;
		}

		if ($stripLow) {
			$flags |= FILTER_FLAG_STRIP_LOW;
		}

		if ($stripHigh) {
			$flags |= FILTER_FLAG_STRIP_HIGH;
		}

		if ($stripBacktick) {
			$flags |= FILTER_FLAG_STRIP_BACKTICK;
		}

		if ($encodeLow) {
			$flags |= FILTER_FLAG_ENCODE_LOW;
		}

		if ($encodeHigh) {
			$flags |= FILTER_FLAG_ENCODE_HIGH;
		}

		if ($encodeAmp) {
			$flags |= FILTER_FLAG_ENCODE_AMP;
		}

		return $this->create(FILTER_SANITIZE_STRING, $flags);
	}

	public function cleanUnsafe(bool $stripLow = false, bool $stripHigh = false, bool $stripBacktick = false, bool $encodeLow = false, bool $encodeHigh = false, bool $encodeAmp = false): RuleInterface
	{
		$flags = 0;

		if ($stripLow) {
			$flags |= FILTER_FLAG_STRIP_LOW;
		}

		if ($stripHigh) {
			$flags |= FILTER_FLAG_STRIP_HIGH;
		}

		if ($stripBacktick) {
			$flags |= FILTER_FLAG_STRIP_BACKTICK;
		}

		if ($encodeLow) {
			$flags |= FILTER_FLAG_ENCODE_LOW;
		}

		if ($encodeHigh) {
			$flags |= FILTER_FLAG_ENCODE_HIGH;
		}

		if ($encodeAmp) {
			$flags |= FILTER_FLAG_ENCODE_AMP;
		}

		return $this->create(FILTER_UNSAFE_RAW, $flags);
	}

	public function cleanUrl(): RuleInterface
	{
		return $this->create(FILTER_SANITIZE_URL);
	}
}
