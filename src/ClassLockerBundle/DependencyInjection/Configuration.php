<?php
/**
 * @category    DivanteClassLocker
 * @date        22/10/2017 10:39
 * @author      Jakub Płaskonka <jplaskonka@divante.pl> | Agata Drozdek <adrozdek@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace ClassLockerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Divante\ClassLockerBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('class_locker');

        $rootNode
            ->children()
                ->arrayNode('classes')
                    ->useAttributeAsKey('name')
                        ->prototype('array')
                            ->scalarPrototype()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
