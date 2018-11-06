<?php
/**
 * @category    DivanteClassLocker
 * @date        25/10/2017 08:46
 * @author      Jakub Płaskonka <jplaskonka@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace ClassLockerBundle\Service;

use Pimcore\Cache\Runtime;
use Pimcore\Model\DataObject\ClassDefinition;
use Pimcore\Model\DataObject\ClassDefinition\Data\Localizedfields;
use Pitpit\Component\Diff\Diff;
use Pitpit\Component\Diff\DiffEngine;

/**
 * Class Service
 *
 * @package Divante\ClassLockerBundle\Service
 */
class ClassLockerService
{

    /**
     * Creates an empty class if it does not exists already
     *
     * @param string $className
     * @return ClassDefinition
     */
    public function createEmptyClass(string $className) : ClassDefinition
    {
        $class = ClassDefinition::getByName($className);
        if (!$class) {
            $class = new ClassDefinition();
            $class->setName($className);
            $class->save();
        }

        return $class;
    }

    /**
     * @param string $className
     * @return array
     */
    public function fetchFieldsFromClass(string $className) : array
    {
        $sharedDefinition   = ClassDefinition::getByName($className);
        $sharedFields       = $sharedDefinition->getFieldDefinitions();
        return $this->fetchFieldsName($sharedFields);
    }

    /**
     * @param ClassDefinition\Data[] $fields
     * @param array $attributes
     * @return array
     */
    public function fetchFieldsName(array $fields, &$attributes = []) : array
    {
        foreach ($fields as $values) {
            if ($values instanceof ClassDefinition\Layout || $values instanceof Localizedfields) {
                $this->fetchFieldsName($values->getChildren(), $attributes);
            } else {
                $attributes[] = $values->getName();
            }
        }
        return $attributes;
    }

    /**
     * @param ClassDefinition $targetClass
     * @return array
     */
    public function fetchSharedAttributesChanges(ClassDefinition $targetClass) : array
    {
        Runtime::clear();
        $originalDefinition = ClassDefinition::getByName($targetClass->getName());
        $originalFields     = $originalDefinition->getFieldDefinitions();
        $engine             = new DiffEngine();
        $diff               = $engine->compare($originalFields, $targetClass->getFieldDefinitions());
        return $this->fetchModifiedAttributesNames($diff);
    }

    /**
     * @param Diff $diff
     * @param array $differences
     * @return array
     */
    protected function fetchModifiedAttributesNames(Diff $diff, &$differences = []) : array
    {
        foreach ($diff as $element) {
            if ($element->isModified()  || $element->isDeleted()) {
                if ($element->getOld() instanceof ClassDefinition\Data) {
                    $differences[] = $element->getOld()->getName();
                }
            }
            if ($diff->isModified()) {
                $this->fetchModifiedAttributesNames($element, $differences);
            }
        }
        return $differences;
    }
}
