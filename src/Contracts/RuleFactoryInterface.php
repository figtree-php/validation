<?php

namespace FigTree\Validation\Contracts;

interface RuleFactoryInterface
{
	/**
	 * Get the name of the RuleInterface implementation.
	 *
	 * @return string
	 */
	public function getRuleClass(): string;

	/**
	 * Set the name of the RuleInterface implementation.
	 *
	 * @param string $ruleClass
	 *
	 * @return \FigTree\Validation\Contracts\RuleFactoryInterface
	 */
	public function setRuleClass(string $ruleClass): RuleFactoryInterface;

	/**
	 * Create a new Rule.
	 *
	 * @param ...mixed $args
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function create(...$args): RuleInterface;
}
