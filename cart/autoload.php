<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'   => __DIR__.'/../vendor/symfony/src',
    'Demo'      => __DIR__.'/../src',
    'Zend\\Log' => __DIR__.'/../vendor/zend-log',
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
    'Swift_'           => __DIR__.'/../vendor/swiftmailer/lib/classes',
));
$loader->register();
