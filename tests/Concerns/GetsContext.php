<?php

namespace FigTree\Validation\Tests\Concerns;

use FigTree\Validation\Core\Context;

trait GetsContext
{
	protected function getContext(): Context
	{
		return new Context(dirname(dirname(__DIR__)));
	}
}
