<?php

namespace FigTree\Validation;

use Closure;
use FigTree\Validation\Concerns\ModifiesFlags;
use FigTree\Validation\Contracts\RuleInterface;
use FigTree\Validation\RuleSets\{
	CleanSet,
	ValidSet
};

class RuleFactory extends AbstractRuleFactory
{
	use ModifiesFlags;

	protected CleanSet $cleanSet;
	protected ValidSet $validSet;

	public function __construct()
	{
		$this->cleanSet = new CleanSet($this);
		$this->validSet = new ValidSet($this);
	}

	public function clean(): CleanSet
	{
		return $this->cleanSet;
	}

	public function valid(): ValidSet
	{
		return $this->validSet;
	}

	/**
	 * Create a Rule for a valid boolean.
	 *
	 * @param callable $callback
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function withCallable(callable $callback): RuleInterface
	{
		return $this->create(FILTER_CALLBACK)
			->setCallback(Closure::fromCallable($callback));
	}

	/**
	 * Create a Rule for a valid boolean.
	 *
	 * @param \Closure $callback
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function withClosure(Closure $callback): RuleInterface
	{
		return $this->create(FILTER_CALLBACK)
			->setCallback($callback);
	}
}
