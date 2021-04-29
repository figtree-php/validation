<?php

namespace FigTree\Validation;

use Closure;
use FigTree\Exceptions\UnexpectedTypeException;
use FigTree\Validation\Contracts\RuleFactoryInterface;

class FilterFactory
{
	public function __construct(protected RuleFactoryInterface $ruleFactory)
	{
		//
	}

	public function create(Closure $closure)
	{
		$filter = new Filter($this->createRules($closure));

		$filter->setRuleFactory($this->ruleFactory);

		return $filter;
	}

	protected function createRules(Closure $closure): array
	{
		$rules = $closure($this->ruleFactory);

		if (!is_array($rules)) {
			throw new UnexpectedTypeException($rules, 'array');
		}

		return $rules;
	}
}
