<?php

namespace FigTree\Validation\Exceptions;

use Throwable;
use FigTree\Exceptions\LogicException;
use FigTree\Validation\Contracts\RuleInterface;

class InvalidRuleException extends LogicException
{
	public function __construct(protected RuleInterface $rule, int $code = 0, Throwable $previous = null)
	{
		$message = 'Invalid Rule.';

		parent::__construct($message, $code, $previous);
	}

	public function getRule(): RuleInterface
	{
		return $this->rule;
	}
}
