<?php

namespace FigTree\Validation;

use Closure;
use FigTree\Validation\Contracts\RuleInterface;

class Rule implements RuleInterface
{
	public function __construct(protected int $filterType, protected int $flags = 0, protected array $options = [], protected ?Closure $callback = null)
	{
		//
	}

	/**
	 * Get the Rule filter type.
	 *
	 * @return integer
	 */
	public function getFilterType(): int
	{
		return $this->filterType;
	}

	/**
	 * Get the Rule flags.
	 *
	 * @return integer
	 */
	public function getFlags(): int
	{
		return $this->flags;
	}

	/**
	 * Check if a Rule flag is set.
	 *
	 * @param integer $flag
	 *
	 * @return boolean
	 */
	public function hasFlag(int $flag): bool
	{
		return $this->flags & $flag;
	}

	/**
	 * Add a Rule flag.
	 *
	 * @param integer $flag
	 *
	 * @return $this
	 */
	public function addFlag(int $flag): RuleInterface
	{
		$this->flags |= $flag;

		return $this;
	}

	/**
	 * Remove a Rule flag.
	 *
	 * @param integer $flag
	 *
	 * @return $this
	 */
	public function removeFlag(int $flag): RuleInterface
	{
		$this->flags &= $flag;

		return $this;
	}

	/**
	 * Get the Rule options.
	 *
	 * @return array
	 */
	public function getOptions(): array
	{
		return $this->options;
	}

	/**
	 * Check if a given Rule option exists.
	 *
	 * @param string $name
	 *
	 * @return boolean
	 */
	public function hasOption(string $name): bool
	{
		return key_exists($name, $this->options);
	}

	/**
	 * Get the value of a given Rule option.
	 *
	 * @param string $name
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	public function getOption(string $name, $default = null)
	{
		return $this->options[$name] ?? $default;
	}

	/**
	 * Set the value of a given Rule option.
	 *
	 * @param string $name
	 * @param mixed $value
	 *
	 * @return $this
	 */
	public function setOption(string $name, $value): RuleInterface
	{
		$this->options[$name] = $value;

		return $this;
	}

	/**
	 * Remove the given option from the Rule.
	 *
	 * @param string $name
	 *
	 * @return $this
	 */
	public function removeOption(string $name): RuleInterface
	{
		unset($this->options[$name]);

		return $this;
	}

	/**
	 * Get the Rule callback.
	 *
	 * @return \Closure|null
	 */
	public function getCallback(): ?Closure
	{
		return $this->callback;
	}

	/**
	 * Get the Rule callback.
	 *
	 * @param \Closure|null $callback
	 *
	 * @return $this
	 */
	public function setCallback(?Closure $callback): RuleInterface
	{
		$this->callback = $callback;

		return $this;
	}

	/**
	 * Cast the Rule into an array.
	 *
	 * @return array
	 */
	public function toArray(): array
	{
		$flags = $this->getFlags();
		$options = $this->getOptions();
		$callback = $this->getCallback();

		$array = [
			'filter' => $this->getFilterType(),
		];

		if ($flags !== 0) {
			$array['flags'] = $flags;
		}

		if (!empty($callback)) {
			$array['options'] = $callback;
		} elseif (!empty($options)) {
			$array['options'] = $options;
		}

		return $array;
	}
}
