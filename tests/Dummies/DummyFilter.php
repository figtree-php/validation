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
			'test_valid_bool' => $this->rules()->valid()->boolean(),
			'test_valid_domain' => $this->rules()->valid()->domain(),
			'test_valid_email' => $this->rules()->valid()->email(),
			'test_valid_float' => $this->rules()->valid()->decimal(-100, 100, 2),
			'test_valid_int' => $this->rules()->valid()->integer(-100, 100),
			'test_valid_ip_address' => $this->rules()->valid()->ipAddress(),
			'test_valid_mac_address' => $this->rules()->valid()->macAddress(),
			'test_valid_regexp' => $this->rules()->valid()->regexp('/^valid value$/i'),

			'test_add_slashes' => $this->rules()->clean()->withSlashes(),
			'test_clean_email' => $this->rules()->clean()->email(),
			'test_clean_encoded' => $this->rules()->clean()->encodedString(),
			'test_clean_float' => $this->rules()->clean()->decimal(),
			'test_clean_full_special_chars' => $this->rules()->clean()->fullSpecialChars(),
			'test_clean_int' => $this->rules()->clean()->digits(),
			'test_clean_special_chars' => $this->rules()->clean()->specialChars(),
			'test_clean_string' => $this->rules()->clean()->str(),
			'test_clean_unsafe' => $this->rules()->clean()->unsafe(),
			'test_clean_url' => $this->rules()->clean()->url(),

			'test_callable' => $this->rules()->withCallable('trim'),
			'test_closure' => $this->rules()->withClosure($this->mult(2)),
		];
	}

	public function mult(int $factor)
	{
		return fn ($value) => intval($value) * $factor;
	}
}
