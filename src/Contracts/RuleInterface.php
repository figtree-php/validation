<?php

namespace FigTree\Validation\Contracts;

use Closure;

interface RuleInterface
{
	/**
	 * Get the Rule filter type.
	 *
	 * @return integer
	 */
	public function getFilterType(): int;

	/**
	 * Get the Rule flags.
	 *
	 * @return integer
	 */
	public function getFlags(): int;

	/**
	 * Check if a Rule flag is set.
	 *
	 * @param integer $flag
	 *
	 * @return boolean
	 */
	public function hasFlag(int $flag): bool;

	/**
	 * Add a Rule flag.
	 *
	 * @param integer $flag
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function addFlag(int $flag): RuleInterface;

	/**
	 * Remove a Rule flag.
	 *
	 * @param integer $flag
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function removeFlag(int $flag): RuleInterface;

	/**
	 * Get the Rule options.
	 *
	 * @return array
	 */
	public function getOptions(): array;

	/**
	 * Check if a given Rule option exists.
	 *
	 * @param string $name
	 *
	 * @return boolean
	 */
	public function hasOption(string $name): bool;

	/**
	 * Get the value of a given Rule option.
	 *
	 * @param string $name
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	public function getOption(string $name, $default = null);

	/**
	 * Set the value of a given Rule option.
	 *
	 * @param string $name
	 * @param mixed $value
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function setOption(string $name, $value): RuleInterface;

	/**
	 * Remove the given option from the Rule.
	 *
	 * @param string $name
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function removeOption(string $name): RuleInterface;

	/**
	 * Get the Rule callback.
	 *
	 * @return \Closure|null
	 */
	public function getCallback(): ?Closure;

	/**
	 * Get the Rule callback.
	 *
	 * @param \Closure|null $callback
	 *
	 * @return \FigTree\Validation\Contracts\RuleInterface
	 */
	public function setCallback(?Closure $callback): RuleInterface;

	/**
	 * Cast the Rule into an array.
	 *
	 * @return array
	 */
	public function toArray(): array;
}
