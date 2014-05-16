<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Security\Http\Firewall;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Interface that must be implemented by firewall listeners
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
interface ListenerInterface
{
    /**
     * The implementation must connect this listener to all necessary events.
     *
     * Typical events are: "core.security", and "core.response"
     *
     * @param EventDispatcherInterface $dispatcher
     */
    function register(EventDispatcherInterface $dispatcher);

    /**
     * The implementation must remove this listener from any events that it had
     * connected to in register().
     *
     * It may remove this listener from "core.security", but this is ensured by
     * the firewall anyway.
     *
     * @param EventDispatcherInterface $dispatcher
     */
    function unregister(EventDispatcherInterface $dispatcher);
}