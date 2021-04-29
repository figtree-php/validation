<?php

namespace FigTree\Validation\Contracts;

interface FilterInterface
{
	/**
	 * Set or remove a RuleFactory.
	 *
	 * @param \FigTree\Validation\Contracts\RuleFactoryInterface $ruleFactory
	 *
	 * @return \FigTree\Validation\Contracts\FilterInterface
	 */
	public function setRuleFactory(RuleFactoryInterface $ruleFactory): FilterInterface;

	/**
	 * Get the set of Rules for this Filter.
	 *
	 * @return array
	 */
	public function getRules(): array;

	/**
	 * Filter a single value against the Filter.
	 *
	 * @param string $field
	 * @param mixed $value
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	public function filterValue(string $field, mixed $value, $default = null): mixed;

	/**
	 * Filter a single input field against the Filter.
	 *
	 * @param integer $type
	 * @param string $field
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	public function filterInput(int $type, string $field, $default = null): mixed;

	/**
	 * Filter an array of values against the Filter.
	 *
	 * @param array $data
	 * @param boolean $addEmpty
	 *
	 * @return mixed
	 */
	public function filterArray(array $data, bool $addEmpty = true): array;

	/**
	 * Filter an array of input values against the Filter.
	 *
	 * @param integer $type
	 * @param boolean $addEmpty
	 *
	 * @return mixed
	 */
	public function filterInputArray(int $type, bool $addEmpty = true): array;
}
