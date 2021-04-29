<?php

namespace FigTree\Validation;

use Closure;
use FigTree\Validation\Contracts\{
	RuleInterface,
	RuleFactoryInterface
};

abstract class AbstractRuleFactory implements RuleFactoryInterface
{
	/**
	 * Create a new Rule.
	 *
	 * @param int $filterType The filter type.
	 * @param int $flags Bitewise set of filter flags.
	 * @param array $options Filter options.
	 * @param \Closure|null Callback method.
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 *
	 * @see https://www.php.net/manual/en/filter.filters.php
	 * @see https://www.php.net/manual/en/filter.filters.flags.php
	 */
	public function create(int $filterType, int $flags = 0, array $options = [], ?Closure $callback = null): RuleInterface
	{
		return new Rule($filterType, $flags, $options, $callback);
	}
}
