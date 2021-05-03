<?php

namespace FigTree\Validation\Contracts;

interface FilterFactoryInterface
{
	/**
	 * Get the assigned RuleFactory instance.
	 *
	 * @return \FigTree\Validation\Contracts\RuleFactoryInterface
	 */
	public function getRuleFactory(): RuleFactoryInterface;

	/**
	 * Create a Filter using Rules.
	 *
	 * @param callable Callback function taking a RuleFactoryInterface and returning an associative array of Rules.
	 *
	 * @return \FigTree\Validation\Contracts\FilterInterface
	 */
	public function create(callable $callback): FilterInterface;
}
