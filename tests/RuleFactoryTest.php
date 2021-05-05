<?php

namespace FigTree\Validation\Tests;

use Closure;
use FigTree\Validation\Contracts\RuleFactoryInterface;
use FigTree\Validation\Contracts\RuleInterface;
use FigTree\Validation\AbstractRuleFactory;
use FigTree\Validation\RuleFactory;

class RuleFactoryTest extends AbstractTestCase
{
	/**
	 * @small
	 */
	public function testRuleFactory()
	{
		$ruleFactory = new RuleFactory();

		$this->assertInstanceOf(RuleFactoryInterface::class, $ruleFactory);
		$this->assertInstanceOf(AbstractRuleFactory::class, $ruleFactory);
	}

	/**
	 * @small
	 */
	public function testAddSlashesRule()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->clean()->withSlashes();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_SANITIZE_ADD_SLASHES, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_ADD_SLASHES, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testCleanEmailRule()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->clean()->email();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_SANITIZE_EMAIL, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_EMAIL, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testCleanEncodedStringRule()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->clean()->encodedString();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_SANITIZE_ENCODED, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_ENCODED, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testCleanFloatRule()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->clean()->decimal();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_SANITIZE_NUMBER_FLOAT, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_NUMBER_FLOAT, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testCleanFullSpecialChars()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->clean()->fullSpecialChars();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_FULL_SPECIAL_CHARS, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testCleanInt()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->clean()->digits();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_SANITIZE_NUMBER_INT, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_NUMBER_INT, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testCleanSpecialChars()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->clean()->specialChars();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_SANITIZE_SPECIAL_CHARS, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_SPECIAL_CHARS, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testCleanString()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->clean()->str();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_SANITIZE_STRING, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_STRING, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testCleanUnsafe()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->clean()->unsafe();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_UNSAFE_RAW, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_UNSAFE_RAW, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testCleanUrl()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->clean()->url();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_SANITIZE_URL, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_SANITIZE_URL, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testValidBool()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->valid()->boolean();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_VALIDATE_BOOLEAN, $rule->getFilterType());
		$this->assertEquals(FILTER_NULL_ON_FAILURE, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_BOOLEAN, $array['filter']);

		$this->assertArrayHasKey('flags', $array);
		$this->assertEquals(FILTER_NULL_ON_FAILURE, ($array['flags'] & FILTER_NULL_ON_FAILURE));
	}

	/**
	 * @small
	 */
	public function testValidDomain()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->valid()->domain();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_VALIDATE_DOMAIN, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_DOMAIN, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testValidEmail()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->valid()->email();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_VALIDATE_EMAIL, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_EMAIL, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testValidFloat()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->valid()->decimal();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_VALIDATE_FLOAT, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_FLOAT, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testValidInt()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->valid()->integer();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_VALIDATE_INT, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_INT, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testValidIpAddress()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->valid()->ipAddress();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_VALIDATE_IP, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_IP, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testValidMacAddress()
	{
		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->valid()->macAddress();

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_VALIDATE_MAC, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_VALIDATE_MAC, $array['filter']);
	}

	/**
	 * @small
	 */
	public function testValidRegExp()
	{
		$pattern = '/^[a-z]+$/i';

		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->valid()->regexp($pattern);

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_VALIDATE_REGEXP, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertNull($rule->getCallback());

		$options = $rule->getOptions();

		$this->assertIsArray($options);
		$this->assertNotEmpty($options);

		$this->assertArrayHasKey('regexp', $options);
		$this->assertEquals($pattern, $options['regexp']);

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

	/**
	 * @small
	 */
	public function testWithCallable()
	{
		$callable = [$this, 'validatorMethod'];

		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->withCallable($callable);

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_CALLBACK, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());

		$this->assertNotNull($rule->getCallback());
		$this->assertInstanceOf(Closure::class, $rule->getCallback());
		$this->assertEquals(Closure::fromCallable($callable), $rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_CALLBACK, $array['filter']);

		$this->assertArrayHasKey('options', $array);
		$this->assertInstanceOf(Closure::class, $array['options']);
		$this->assertEquals(Closure::fromCallable($callable), $array['options']);
	}

	/**
	 * @small
	 */
	public function testWithClosure()
	{
		$closure = Closure::fromCallable([$this, 'validatorMethod']);

		$ruleFactory = new RuleFactory();

		$rule = $ruleFactory->withClosure($closure);

		$this->assertInstanceOf(RuleInterface::class, $rule);

		$this->assertEquals(FILTER_CALLBACK, $rule->getFilterType());
		$this->assertEquals(0, $rule->getFlags());
		$this->assertIsArray($rule->getOptions());
		$this->assertEmpty($rule->getOptions());

		$this->assertNotNull($rule->getCallback());
		$this->assertInstanceOf(Closure::class, $rule->getCallback());
		$this->assertEquals($closure, $rule->getCallback());

		$array = $rule->toArray();

		$this->assertIsArray($array);

		$this->assertArrayHasKey('filter', $array);
		$this->assertEquals(FILTER_CALLBACK, $array['filter']);

		$this->assertArrayHasKey('options', $array);
		$this->assertInstanceOf(Closure::class, $array['options']);
		$this->assertEquals($closure, $array['options']);
	}

	public function validatorMethod($value)
	{
		return (is_string($value) && $value == 'foo');
	}
}
