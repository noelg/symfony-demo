<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Config\Loader;

/**
 * Loader is the abstract class used by all built-in loaders.
 *
 * @author Fabien Potencier <fabien.potencier@symfony-project.com>
 */
abstract class Loader implements LoaderInterface
{
    protected $resolver;

    /**
     * Gets the loader resolver.
     *
     * @return LoaderResolver A LoaderResolver instance
     */
    public function getResolver()
    {
        return $this->resolver;
    }

    /**
     * Sets the loader resolver.
     *
     * @param LoaderResolver $resolver A LoaderResolver instance
     */
    public function setResolver(LoaderResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Adds definitions and parameters from a resource.
     *
     * @param mixed  $resource A Resource
     * @param string $type     The resource type
     */
    public function import($resource, $type = null)
    {
        $this->resolve($resource)->load($resource, $type);
    }

    /**
     * Finds a loader able to load an imported resource.
     *
     * @param mixed  $resource A Resource
     * @param string $type     The resource type
     *
     * @return LoaderInterface A LoaderInterface instance
     *
     * @throws \InvalidArgumentException if no loader is found
     */
    public function resolve($resource, $type = null)
    {

        if ($this->supports($resource, $type)) {
            return $this;
        }

        $loader = null === $this->resolver ? false : $this->resolver->resolve($resource, $type);

        if (false === $loader) {
            throw new \InvalidArgumentException(sprintf('Unable to load the "%s" resource.', is_string($resource) ? $resource : (is_object($resource) ? get_class($resource) : 'RESOURCE')));
        }

        return $loader;
    }

}
