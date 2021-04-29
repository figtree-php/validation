<?php

namespace FigTree\Validation\Tests\Dummies;

use FigTree\Validation\AbstractFilter;

class DummyFilter extends AbstractFilter
{
	public function getRules(): array
	{
		/**
		 * @var \FigTree\Validation\RuleFactory
		 */
		$rules = $this->ruleFactory;

		return [
			'test_valid_bool' => $rules->validBool(),
			'test_valid_domain' => $rules->validDomain(),
			'test_valid_email' => $rules->validEmail(),
			'test_valid_float' => $rules->validFloat(-100, 100, 2),
			'test_valid_int' => $rules->validInt(-100, 100),
			'test_valid_ip_address' => $rules->validIpAddress(),
			'test_valid_mac_address' => $rules->validMacAddress(),
			'test_valid_regexp' => $rules->validRegExp('/^valid value$/i'),

			'test_add_slashes' => $rules->addSlashes(),
			'test_clean_email' => $rules->cleanEmail(),
			'test_clean_encoded' => $rules->cleanEncodedString(),
			'test_clean_float' => $rules->cleanFloat(),
			'test_clean_full_special_chars' => $rules->cleanFullSpecialChars(),
			'test_clean_int' => $rules->cleanInt(),
			'test_clean_special_chars' => $rules->cleanSpecialChars(),
			'test_clean_string' => $rules->cleanString(),
			'test_clean_unsafe' => $rules->cleanUnsafe(),
			'test_clean_url' => $rules->cleanUrl(),

			'test_callable' => $rules->withCallable('trim'),
			'test_closure' => $rules->withClosure($this->mult(2)),
		];
	}

	public function mult(int $factor)
	{
		return fn ($value) => intval($value) * $factor;
	}
}
