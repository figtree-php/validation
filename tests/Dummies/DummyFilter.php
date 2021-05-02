<?php

namespace FigTree\Validation\Tests\Dummies;

use FigTree\Validation\AbstractFilter;

class DummyFilter extends AbstractFilter
{
	/**
	 * @return \FigTree\Validation\RuleFactory
	 */
	protected function rules()
	{
		return $this->ruleFactory;
	}

	public function getRules(): array
	{
		return [
			'test_valid_bool' => $this->rules()->validBool(),
			'test_valid_domain' => $this->rules()->validDomain(),
			'test_valid_email' => $this->rules()->validEmail(),
			'test_valid_float' => $this->rules()->validFloat(-100, 100, 2),
			'test_valid_int' => $this->rules()->validInt(-100, 100),
			'test_valid_ip_address' => $this->rules()->validIpAddress(),
			'test_valid_mac_address' => $this->rules()->validMacAddress(),
			'test_valid_regexp' => $this->rules()->validRegExp('/^valid value$/i'),

			'test_add_slashes' => $this->rules()->addSlashes(),
			'test_clean_email' => $this->rules()->cleanEmail(),
			'test_clean_encoded' => $this->rules()->cleanEncodedString(),
			'test_clean_float' => $this->rules()->cleanFloat(),
			'test_clean_full_special_chars' => $this->rules()->cleanFullSpecialChars(),
			'test_clean_int' => $this->rules()->cleanInt(),
			'test_clean_special_chars' => $this->rules()->cleanSpecialChars(),
			'test_clean_string' => $this->rules()->cleanString(),
			'test_clean_unsafe' => $this->rules()->cleanUnsafe(),
			'test_clean_url' => $this->rules()->cleanUrl(),

			'test_callable' => $this->rules()->withCallable('trim'),
			'test_closure' => $this->rules()->withClosure($this->mult(2)),
		];
	}

	public function mult(int $factor)
	{
		return fn ($value) => intval($value) * $factor;
	}
}
