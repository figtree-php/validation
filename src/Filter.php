<?php

namespace FigTree\Validation;

class Filter extends AbstractFilter
{
	public function __construct(protected array $rules)
	{
		//
	}

	/**
	 * Get the set of Rules for this Filter.
	 *
	 * @return array
	 */
	public function getRules(): array
	{
		return $this->rules;
	}
}
