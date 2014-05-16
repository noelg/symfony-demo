<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection;

class Alias
{
    protected $id;
    protected $public;

    /**
     * Constructor.
     *
     * @param string $id Alias identifier
     * @param boolean $public If this alias is public
     */
    public function __construct($id, $public = true)
    {
        $this->id = strtolower($id);
        $this->public = $public;
    }

    /**
     * Checks if this DI Alias should be public or not.
     *
     * @return boolean
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * Sets if this Alias is public.
     *
     * @param boolean $boolean If this Alias should be public
     */
    public function setPublic($boolean)
    {
        $this->public = (Boolean) $boolean;
    }

    /**
     * Returns the Id of this alias.
     *
     * @return string The alias id
     */
    public function __toString()
    {
        return $this->id;
    }
}