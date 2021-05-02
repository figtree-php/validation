<?php

namespace FigTree\Validation;

use FigTree\Validation\Contracts\{
	FilterInterface,
	RuleFactoryInterface,
	RuleInterface
};
use FigTree\Validation\Exceptions\InvalidRuleException;

abstract class AbstractFilter implements FilterInterface
{
	protected RuleFactoryInterface $ruleFactory;

	/**
	 * Set or remove a RuleFactory.
	 *
	 * @param \FigTree\Validation\Contracts\RuleFactoryInterface $ruleFactory
	 *
	 * @return $this
	 */
	public function setRuleFactory(RuleFactoryInterface $ruleFactory): FilterInterface
	{
		$this->ruleFactory = $ruleFactory;

		return $this;
	}

	/**
	 * Filter a single value against the Filter.
	 *
	 * @param string $field
	 * @param mixed $value
	 *
	 * @return mixed
	 */
	public function filterValue(string $field, mixed $value, $default = null): mixed
	{
		$definition = $this->getDefinition($field);

		if (empty($definition)) {
			return $default;
		}

		$filter = $definition['filter'];

		if (empty($filter)) {
			throw new InvalidRuleException($this->getRule($field));
		}

		return filter_var($value, $filter, $definition);
	}

	/**
	 * Filter a single input field against the Filter.
	 *
	 * @param integer $type
	 * @param string $field
	 *
	 * @return mixed
	 */
	public function filterInput(int $type, string $field, $default = null): mixed
	{
		$definition = $this->getDefinition($field);

		if (empty($definition)) {
			return $default;
		}

		$filter = $definition['filter'];

		if (empty($filter)) {
			throw new InvalidRuleException($this->getRule($field));
		}

		return filter_input($type, $field, $filter, $definition);
	}

	/**
	 * Filter an array of values against the Filter.
	 *
	 * @param array $data
	 * @param boolean $addEmpty
	 *
	 * @return mixed
	 */
	public function filterArray(array $data, bool $addEmpty = true): array
	{
		$definitions = $this->getDefinitions();

		$input = filter_var_array($data, $definitions, $addEmpty);

		if (!is_array($input)) {
			$input = ($addEmpty)
				? array_fill_keys(array_keys($definitions), null)
				: [];
		}

		return $input;
	}

	/**
	 * Filter an array of input values against the Filter.
	 *
	 * @param integer $type
	 * @param boolean $addEmpty
	 *
	 * @return mixed
	 */
	public function filterInputArray(int $type, bool $addEmpty = true): array
	{
		$definitions = $this->getDefinitions();

		$input = filter_input_array($type, $definitions, $addEmpty);

		if (!is_array($input)) {
			$input = ($addEmpty)
				? array_fill_keys(array_keys($definitions), null)
				: [];
		}

		return $input;
	}

	/**
	 * Get a single Rule.
	 *
	 * @param string $field
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface|null
	 */
	protected function getRule(string $field): ?RuleInterface
	{
		$rules = $this->getRules();

		return $rules[$field] ?? null;
	}

	/**
	 * Get a single Rule as a native filter definition.
	 *
	 * @param string $field
	 *
	 * @return array|null
	 */
	protected function getDefinition(string $field): ?array
	{
		$rule = $this->getRule($field);

		if (!($rule instanceof RuleInterface)) {
			return null;
		}

		return $rule->toArray();
	}

	/**
	 * Get the Rules as a native filter definition.
	 *
	 * @return array
	 */
	protected function getDefinitions(): array
	{
		return array_map(
			fn (RuleInterface $rule) => $rule->toArray(),
			$this->getRules()
		);
	}
}
