<?php
/**
 * @category    Wurth
 * @date        22/10/2017 10:39
 * @author      Jakub Płaskonka <jplaskonka@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace Divante\ClassLockerBundle;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;

/**
 * Class DivanteClassLockerBundle
 * @package Divante\ClassLockerBundle
 */
class DivanteClassLockerBundle extends AbstractPimcoreBundle
{

    /**
     * @return array
     */
    public function getJsPaths()
    {
        return [
            '/bundles/divanteclasslocker/js/pimcore/startup.js',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getNiceName()
    {
        return "Divante Class Locker";
    }

    /**
     * @inheritdoc
     */
    public function getVersion()
    {
        return "2.0.0";
    }
}
