<?php

namespace FigTree\Validation\Tests\Support;

use const FILTER_SANITIZE_FULL_SPECIAL_CHARS;

use Closure;
use FigTree\Exceptions\UnexpectedTypeException;
use FigTree\Validation\{
	Contracts\FilterInterface,
	Contracts\RuleInterface,
	AbstractRuleFactory,
	Filter,
	FilterFactory,
	Rule,
	RuleFactory,
};
use FigTree\Validation\Contracts\RuleFactoryInterface;
use FigTree\Validation\Tests\{
	AbstractTestCase,
	Dummies\DummyFilter,
};

class FilterTest extends AbstractTestCase
{
	/**
	 * @small
	 *
	 * @return void
	 */
	public function testFilterFactory()
	{
		$ruleFactory = new RuleFactory();

		$filterFactory = new FilterFactory($ruleFactory);

		$this->assertNotNull($filterFactory->getRuleFactory());
		$this->assertInstanceOf(RuleFactoryInterface::class, $filterFactory->getRuleFactory());
		$this->assertInstanceOf(AbstractRuleFactory::class, $filterFactory->getRuleFactory());
		$this->assertInstanceOf(RuleFactory::class, $filterFactory->getRuleFactory());

		$filter = $filterFactory
			->create(function (RuleFactory $rules) {
				$rules = [
					'int' => $rules->validInt(0, 10),
				];

				return $rules;
			});

		$this->assertInstanceOf(Filter::class, $filter);
	}

	/**
	 * @small
	 *
	 * @return void
	 */
	public function testFilterFactoryInvalidReturnType()
	{
		$ruleFactory = new RuleFactory();

		$filterFactory = new FilterFactory($ruleFactory);

		$this->expectException(UnexpectedTypeException::class);
		$this->expectExceptionMessage(sprintf('Expected value of type array; NULL given.', RuleInterface::class));

		$filterFactory
			->create(function (RuleFactory $rules) {
				return null;
			});
	}

	/**
	 * @small
	 *
	 * @return void
	 */
	public function testFilterFactoryInvalidReturnKeys()
	{
		$ruleFactory = new RuleFactory();

		$filterFactory = new FilterFactory($ruleFactory);

		$this->expectException(UnexpectedTypeException::class);
		$this->expectExceptionMessage(sprintf('Expected value of type associative array; array given.', RuleInterface::class));

		$filterFactory
			->create(function (RuleFactory $rules) {
				return [
					$rules->cleanEmail(),
				];
			});
	}


	/**
	 * @small
	 *
	 * @return void
	 */
	public function testFilterFactoryInvalidReturnValues()
	{
		$ruleFactory = new RuleFactory();

		$filterFactory = new FilterFactory($ruleFactory);

		$this->expectException(UnexpectedTypeException::class);
		$this->expectExceptionMessage(sprintf('Expected value of type %s; string given.', RuleInterface::class));

		$filterFactory
			->create(function (RuleFactory $rules) {
				return [
					'foo' => 'bar',
				];
			});
	}

	/**
	 * @small
	 *
	 * @return void
	 */
	public function testFilter()
	{
		$filter = new DummyFilter();

		$filter->setRuleFactory(new RuleFactory());

		$this->assertInstanceOf(FilterInterface::class, $filter);

		$rules = $filter->getRules();

		$this->assertIsArray($rules);

		foreach ($rules as $field => $rule) {
			$this->assertIsString($field);
			$this->assertInstanceOf(RuleInterface::class, $rule);

			$definition = $rule->toArray();

			$this->assertIsArray($definition);
		}
	}

	/**
	 * @medium
	 */
	public function testFilterRules()
	{
		$filter = new DummyFilter();

		$filter->setRuleFactory(new RuleFactory());

		$rules = $filter->getRules();

		$expected = [
			'filter' => FILTER_VALIDATE_BOOL,
			'flags' => FILTER_NULL_ON_FAILURE,
		];

		$this->assertEquals(new Rule(FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE), $rules['test_valid_bool']);
		$this->assertEquals($expected, $rules['test_valid_bool']->toArray());

		$expected = [
			'filter' => FILTER_VALIDATE_DOMAIN,
		];

		$this->assertEquals(new Rule(FILTER_VALIDATE_DOMAIN), $rules['test_valid_domain']);
		$this->assertEquals($expected, $rules['test_valid_domain']->toArray());

		$expected = [
			'filter' => FILTER_VALIDATE_EMAIL,
		];

		$this->assertEquals(new Rule(FILTER_VALIDATE_EMAIL), $rules['test_valid_email']);
		$this->assertEquals($expected, $rules['test_valid_email']->toArray());

		$expected = [
			'filter' => FILTER_VALIDATE_FLOAT,
			'options' => [
				'min_range' => -100,
				'max_range' => 100,
				'decimal' => 2,
			]
		];

		$this->assertEquals(
			new Rule(FILTER_VALIDATE_FLOAT, 0, ['min_range' => -100, 'max_range' => 100, 'decimal' => 2]),
			$rules['test_valid_float']
		);
		$this->assertEquals($expected, $rules['test_valid_float']->toArray());

		$expected = [
			'filter' => FILTER_VALIDATE_INT,
			'options' => [
				'min_range' => -100,
				'max_range' => 100,
			]
		];

		$this->assertEquals(
			new Rule(FILTER_VALIDATE_INT, 0, ['min_range' => -100, 'max_range' => 100]),
			$rules['test_valid_int']
		);
		$this->assertEquals($expected, $rules['test_valid_int']->toArray());

		$expected = [
			'filter' => FILTER_VALIDATE_IP,
		];

		$this->assertEquals(new Rule(FILTER_VALIDATE_IP), $rules['test_valid_ip_address']);
		$this->assertEquals($expected, $rules['test_valid_ip_address']->toArray());

		$expected = [
			'filter' => FILTER_VALIDATE_MAC,
		];

		$this->assertEquals(new Rule(FILTER_VALIDATE_MAC), $rules['test_valid_mac_address']);
		$this->assertEquals($expected, $rules['test_valid_mac_address']->toArray());

		$expected = [
			'filter' => FILTER_VALIDATE_REGEXP,
			'options' => [
				'regexp' => '/^valid value$/i',
			]
		];

		$this->assertEquals(
			new Rule(FILTER_VALIDATE_REGEXP, 0, ['regexp' => '/^valid value$/i']),
			$rules['test_valid_regexp']
		);
		$this->assertEquals($expected, $rules['test_valid_regexp']->toArray());

		$expected = [
			'filter' => FILTER_SANITIZE_ADD_SLASHES,
		];

		$this->assertEquals(
			new Rule(FILTER_SANITIZE_ADD_SLASHES),
			$rules['test_add_slashes']
		);
		$this->assertEquals($expected, $rules['test_add_slashes']->toArray());

		$expected = [
			'filter' => FILTER_SANITIZE_EMAIL,
		];

		$this->assertEquals(
			new Rule(FILTER_SANITIZE_EMAIL),
			$rules['test_clean_email']
		);
		$this->assertEquals($expected, $rules['test_clean_email']->toArray());

		$expected = [
			'filter' => FILTER_SANITIZE_ENCODED,
		];

		$this->assertEquals(
			new Rule(FILTER_SANITIZE_ENCODED),
			$rules['test_clean_encoded']
		);
		$this->assertEquals($expected, $rules['test_clean_encoded']->toArray());

		$expected = [
			'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
		];

		$this->assertEquals(
			new Rule(FILTER_SANITIZE_NUMBER_FLOAT),
			$rules['test_clean_float']
		);
		$this->assertEquals($expected, $rules['test_clean_float']->toArray());

		$expected = [
			'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		];

		$this->assertEquals(
			new Rule(FILTER_SANITIZE_FULL_SPECIAL_CHARS),
			$rules['test_clean_full_special_chars']
		);
		$this->assertEquals($expected, $rules['test_clean_full_special_chars']->toArray());

		$expected = [
			'filter' => FILTER_SANITIZE_NUMBER_INT,
		];

		$this->assertEquals(
			new Rule(FILTER_SANITIZE_NUMBER_INT),
			$rules['test_clean_int']
		);
		$this->assertEquals($expected, $rules['test_clean_int']->toArray());

		$expected = [
			'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
		];

		$this->assertEquals(
			new Rule(FILTER_SANITIZE_SPECIAL_CHARS),
			$rules['test_clean_special_chars']
		);
		$this->assertEquals($expected, $rules['test_clean_special_chars']->toArray());

		$expected = [
			'filter' => FILTER_SANITIZE_STRING,
		];

		$this->assertEquals(
			new Rule(FILTER_SANITIZE_STRING),
			$rules['test_clean_string']
		);
		$this->assertEquals($expected, $rules['test_clean_string']->toArray());

		$expected = [
			'filter' => FILTER_UNSAFE_RAW,
		];

		$this->assertEquals(
			new Rule(FILTER_UNSAFE_RAW),
			$rules['test_clean_unsafe']
		);
		$this->assertEquals($expected, $rules['test_clean_unsafe']->toArray());

		$expected = [
			'filter' => FILTER_SANITIZE_URL,
		];

		$this->assertEquals(
			new Rule(FILTER_SANITIZE_URL),
			$rules['test_clean_url']
		);
		$this->assertEquals($expected, $rules['test_clean_url']->toArray());

		$expected = [
			'filter' => FILTER_CALLBACK,
			'options' => Closure::fromCallable('trim'),
		];

		$this->assertEquals(
			(new Rule(FILTER_CALLBACK))->setCallback(Closure::fromCallable('trim')),
			$rules['test_callable']
		);
		$this->assertEquals($expected, $rules['test_callable']->toArray());

		$expected = [
			'filter' => FILTER_CALLBACK,
			'options' => $filter->mult(2),
		];

		$this->assertEquals(
			(new Rule(FILTER_CALLBACK))->setCallback($filter->mult(2)),
			$rules['test_closure']
		);
		$this->assertEquals($expected, $rules['test_closure']->toArray());
	}
}
