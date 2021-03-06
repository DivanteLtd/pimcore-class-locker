<?php
/**
 * @category    DivanteClassLocker
 * @date        22/10/2017 10:39
 * @author      Jakub Płaskonka <jplaskonka@divante.pl> | Agata Drozdek <adrozdek@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace ClassLockerBundle\DependencyInjection;

use ClassLockerBundle\EventListener\ClassListener;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class ClassLockerExtension extends Extension
{
    /**
     * {@inheritdoc}
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}
