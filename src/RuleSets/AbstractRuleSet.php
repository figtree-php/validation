<?php

namespace FigTree\Validation\RuleSets;

use FigTree\Validation\Concerns\ModifiesFlags;
use FigTree\Validation\Contracts\RuleFactoryInterface;

abstract class AbstractRuleSet
{
	use ModifiesFlags;

	public function __construct(protected RuleFactoryInterface $factory)
	{
		//
	}
}
