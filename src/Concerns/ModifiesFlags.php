<?php

namespace FigTree\Validation\Concerns;

trait ModifiesFlags
{
	/**
	 * Add a flag if the given condition is true.
	 *
	 * @param int $flags The flags being modified.
	 * @param bool $condition The condition being checked.
	 * @param int $flag The flag being added.
	 *
	 * @return int
	 */
	protected function addFlagIf(int $flags, bool $condition, int $flag): int
	{
		if ($condition) {
			$flags |= $flag;
		}

		return $flags;
	}


	/**
	 * Add a set of flags if their given conditions are true.
	 *
	 * @param int $flags The flags being modified.
	 * @param array $flagConditions An array of flags and their conditions to determine if they should be added.
	 *
	 * @return int
	 */
	protected function addFlagsIf(int $flags, array $flagConditions): int
	{
		foreach ($flagConditions as $flag => $condition) {
			if (is_int($flag) && is_bool($condition)) {
				$flags = $this->addFlagIf($flags, $condition, $flag);
			}
		}

		return $flags;
	}
}