<?php

namespace FigTree\Validation\Tests;

use Closure;
use FigTree\Validation\Contracts\RuleInterface;
use FigTree\Validation\RuleFactory;

class RuleFactoryTest extends AbstractTestCase
{
	public function testAddSlashesRule()
	{
		$rule = $this->ruleFactory()->addSlashes();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_ADD_SLASHES, $array['filter']);
	}

	public function testCleanEmailRule()
	{
		$rule = $this->ruleFactory()->cleanEmail();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_EMAIL, $array['filter']);
	}

	public function testCleanEncodedStringRule()
	{
		$rule = $this->ruleFactory()->cleanEncodedString();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_ENCODED, $array['filter']);
	}

	public function testCleanFloatRule()
	{
		$rule = $this->ruleFactory()->cleanFloat();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_NUMBER_FLOAT, $array['filter']);
	}

	public function testCleanFullSpecialChars()
	{
		$rule = $this->ruleFactory()->cleanFullSpecialChars();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $array['filter']);
	}

	public function testCleanInt()
	{
		$rule = $this->ruleFactory()->cleanInt();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_NUMBER_INT, $array['filter']);
	}

	public function testCleanSpecialChars()
	{
		$rule = $this->ruleFactory()->cleanSpecialChars();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_SPECIAL_CHARS, $array['filter']);
	}

	public function testCleanString()
	{
		$rule = $this->ruleFactory()->cleanString();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_STRING, $array['filter']);
	}

	public function testCleanUnsafe()
	{
		$rule = $this->ruleFactory()->cleanUnsafe();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_UNSAFE_RAW, $array['filter']);
	}

	public function testCleanUrl()
	{
		$rule = $this->ruleFactory()->cleanUrl();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_URL, $array['filter']);
	}

	public function testValidBool()
	{
		$rule = $this->ruleFactory()->validBool();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_BOOLEAN, $array['filter']);

		$this->assertArrayHasKey('flags', $array);
		$this->assertEquals(FILTER_NULL_ON_FAILURE, ($array['flags'] & FILTER_NULL_ON_FAILURE));
	}

	public function testValidDomain()
	{
		$rule = $this->ruleFactory()->validDomain();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_DOMAIN, $array['filter']);
	}

	public function testValidEmail()
	{
		$rule = $this->ruleFactory()->validEmail();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_EMAIL, $array['filter']);
	}

	public function testValidFloat()
	{
		$rule = $this->ruleFactory()->validFloat();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_FLOAT, $array['filter']);
	}

	public function testValidInt()
	{
		$rule = $this->ruleFactory()->validInt();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_INT, $array['filter']);
	}

	public function testValidIpAddress()
	{
		$rule = $this->ruleFactory()->validIpAddress();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_IP, $array['filter']);
	}

	public function testValidMacAddress()
	{
		$rule = $this->ruleFactory()->validMacAddress();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_MAC, $array['filter']);
	}

	public function testValidRegExp()
	{
		$pattern = '/^[a-z]+$/i';

		$rule = $this->ruleFactory()->validRegExp($pattern);

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_REGEXP, $array['filter']);

		$this->assertArrayHasKey('options', $array);
		$this->assertIsArray($array['options']);

		$options = $array['options'];

		$this->assertArrayHasKey('regexp', $options);
		$this->assertEquals($pattern, $options['regexp']);
	}

	public function testWithCallable()
	{
		$callable = [$this, 'validatorMethod'];

		$rule = $this->ruleFactory()->withCallable($callable);

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_CALLBACK, $array['filter']);
	}

	public function testWithClosure()
	{
		$closure = Closure::fromCallable([$this, 'validatorMethod']);

		$rule = $this->ruleFactory()->withClosure($closure);

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_CALLBACK, $array['filter']);
	}

	public function validatorMethod($value)
	{
		return (is_string($value) && $value == 'foo');
	}

	protected function ruleFactory()
	{
		return new RuleFactory();
	}
}
