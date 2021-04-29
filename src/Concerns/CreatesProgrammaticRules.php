<?php

namespace FigTree\Validation\Concerns;

use Closure;
use FigTree\Validation\Contracts\RuleInterface;

trait CreatesProgrammaticRules
{
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
