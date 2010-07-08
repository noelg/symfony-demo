<?php

namespace Symfony\Framework\ZendBundle\DependencyInjection;

use Symfony\Components\DependencyInjection\Loader\LoaderExtension;
use Symfony\Components\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Components\DependencyInjection\BuilderConfiguration;

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * ZendExtension is an extension for the Zend Framework libraries.
 *
 * @package    Symfony
 * @subpackage Framework_ZendBundle
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class ZendExtension extends LoaderExtension
{
    protected $resources = array(
        'logger' => 'logger.xml',
        'i18n' => 'i18n.xml'
    );

    /**
     * Loads the logger configuration.
     *
     * Usage example:
     *
     *      <zend:logger priority="info" path="/path/to/some.log" />
     *
     * @param array                $config        A configuration array
     * @param BuilderConfiguration $configuration A BuilderConfiguration instance
     *
     * @return BuilderConfiguration A BuilderConfiguration instance
     */
    public function loggerLoad($config, BuilderConfiguration $configuration)
    {
        if (!$configuration->hasDefinition('zend.logger')) {
            $loader = new XmlFileLoader(__DIR__.'/../Resources/config');
            $configuration->merge($loader->load($this->resources['logger']));
            $configuration->setAlias('logger', 'zend.logger');
        }

        if (isset($config['priority'])) {
            $configuration->setParameter('zend.logger.priority', is_int($config['priority']) ? $config['priority'] : constant('\\Zend\\Log\\Logger::'.strtoupper($config['priority'])));
        }

        if (isset($config['path'])) {
            $configuration->setParameter('zend.logger.path', $config['path']);
        }

        return $configuration;
    }

    /**
     * Loads the i18n configuration.
     *
     * Usage example:
     *
     *      <zend:i18n locale="en" adapter="xliff" data="/path/to/messages.xml" />
     *
     * @param array                $config        A configuration array
     * @param BuilderConfiguration $configuration A BuilderConfiguration instance
     *
     * @return BuilderConfiguration A BuilderConfiguration instance
     */
    public function i18nLoad($config, BuilderConfiguration $configuration)
    {
        if (!$configuration->hasDefinition('zend.i18n')) {
            $loader = new XmlFileLoader(__DIR__.'/../Resources/config');
            $configuration->merge($loader->load($this->resources['i18n']));
            $configuration->setAlias('i18n', 'zend.i18n');
        }

        if (isset($config['locale'])) {
            $configuration->setParameter('zend.translator.locale', $config['locale']);
        }
        
        if (isset($config['adapter'])) {
            $configuration->setParameter('zend.translator.adapter', constant($config['adapter']));
        }

        if (isset($config['translations']) && is_array($config['translations'])) {
            foreach ($config['translations'] as $locale => $catalogue) {
                if ($locale == $configuration->getParameter('zend.translator.locale')) {
                  $configuration->setParameter('zend.translator.catalogue', $catalogue);
                }
                $configuration->findDefinition('zend.translator')->addMethodCall('addTranslation', array($catalogue, $locale));
            }
        }

        return $configuration;
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/zend';
    }

    public function getAlias()
    {
        return 'zend';
    }
}
