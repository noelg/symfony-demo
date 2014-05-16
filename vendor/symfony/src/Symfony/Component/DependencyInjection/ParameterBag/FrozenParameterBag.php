<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\ParameterBag;

/**
 *
 * @author Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class FrozenParameterBag extends ParameterBag
{
    /**
     * Constructor.
     *
     * For performance reasons, the constructor assumes that
     * all keys are already lowercased.
     *
     * This is always the case when used internally.
     *
     * @param array $parameters An array of parameters
     */
    public function __construct(array $parameters = array())
    {
        $this->parameters = $parameters;
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        throw new \LogicException('Impossible to call clear() on a frozen ParameterBag.');
    }

    /**
     * {@inheritDoc}
     */
    public function add(array $parameters)
    {
        throw new \LogicException('Impossible to call add() on a frozen ParameterBag.');
    }

    /**
     * {@inheritDoc}
     */
    public function set($name, $value)
    {
        throw new \LogicException('Impossible to call set() on a frozen ParameterBag.');
    }
}
