<?php

namespace FigTree\Validation;

use FigTree\Exceptions\UnexpectedTypeException;
use FigTree\Validation\Contracts\{
	FilterFactoryInterface,
	FilterInterface,
	RuleFactoryInterface,
	RuleInterface,
};

class FilterFactory implements FilterFactoryInterface
{
	/**
	 * Construct an instance of FilterFactory.
	 */
	public function __construct(protected RuleFactoryInterface $ruleFactory)
	{
		//
	}

	/**
	 * Get the assigned RuleFactory instance.
	 *
	 * @return \FigTree\Validation\Contracts\RuleFactoryInterface
	 */
	public function getRuleFactory(): RuleFactoryInterface
	{
		return $this->ruleFactory;
	}

	/**
	 * Create a Filter using Rules.
	 *
	 * @param callable Callback function taking a RuleFactoryInterface and returning an associative array of Rules.
	 *
	 * @return \FigTree\Validation\Contracts\FilterInterface
	 */
	public function create(callable $callback): FilterInterface
	{
		$rules = $this->createRules($callback);

		$filter = new Filter($rules);

		$filter->setRuleFactory($this->ruleFactory);

		return $filter;
	}

	/**
	 * Run the creation callback method and validate its results.
	 *
	 * @param callable Callback function taking a RuleFactoryInterface and returning an associative array of Rules.
	 *
	 * @return array
	 */
	protected function createRules(callable $callback): array
	{
		$rules = $callback($this->ruleFactory);

		if (!is_array($rules)) {
			throw new UnexpectedTypeException($rules, 'array');
		}

		if (array_is_list($rules)) {
			throw new UnexpectedTypeException($rules, 'associative array');
		}

		array_walk($rules, function ($rule, $key) {
			if (!($rule instanceof RuleInterface)) {
				throw new UnexpectedTypeException($rule, RuleInterface::class);
			}
		});

		return $rules;
	}
}
