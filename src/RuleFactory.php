<?php

namespace FigTree\Validation;

use FigTree\Validation\Concerns\{
	CreatesProgrammaticRules,
	CreatesSanitationRules,
	CreatesValidationRules,
};

class RuleFactory extends AbstractRuleFactory
{
	use CreatesProgrammaticRules;
	use CreatesSanitationRules;
	use CreatesValidationRules;
}
