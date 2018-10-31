<?php
/**
 * @category    DivanteClassLocker
 * @date        22/10/2017 10:39
 * @author      Jakub Płaskonka <jplaskonka@divante.pl> | Michal Bolka <mbolka@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace Divante\ClassLockerBundle\EventListener;

use Divante\ClassLockerBundle\Service\ClassLockerService;
use Pimcore\Event\Model\DataObject\ClassDefinitionEvent;
use Pimcore\Model\DataObject\ClassDefinition;

/**
 * Class ClassListener
 * @package Divante\ClassLockerBundle\EventListener
 */
class ClassListener
{
    /** @var ClassLockerService */
    protected $lockerService;

    /**
     * @var array
     */
    protected $lockedClasses;

    /**
     * ClassListener constructor.
     * @param ClassLockerService $lockerService
     * @param array              $lockedClasses
     */
    public function __construct(ClassLockerService $lockerService, array $lockedClasses)
    {
        $this->lockerService = $lockerService;
        $this->lockedClasses = $lockedClasses;
    }

    /**
     * @param ClassDefinitionEvent $classDefinitionEvent
     * @throws \Exception
     * @return void
     */
    public function onPreUpdate(ClassDefinitionEvent $classDefinitionEvent): void
    {
        $classDefinition = $classDefinitionEvent->getClassDefinition();
        if (array_key_exists($classDefinition->getName(), $this->lockedClasses)) {
            $this->preProcessTargetClass($classDefinition);
        }
    }

    /**
     * @param ClassDefinition $targetClass
     * @throws \Exception
     * @return void
     */
    protected function preProcessTargetClass(ClassDefinition $targetClass): void
    {
        $sharedFieldsNames = $this->lockedClasses[$targetClass->getName()] ?: [];

        $differences       = $this->lockerService->fetchSharedAttributesChanges($targetClass);
        $intersectedValues = array_intersect($sharedFieldsNames, $differences);
        $count             = count($intersectedValues);

        if ($count > 0) {
            $glue = (php_sapi_name() == "cli") ? "\n" : "<br/>";
            throw new \Exception("You cannot modify following fields:<br/> " . implode($glue, $sharedFieldsNames));
        }
    }
}
