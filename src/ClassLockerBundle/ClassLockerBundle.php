<?php
/**
 * @category    ClassLocker
 * @date        22/10/2017 10:39
 * @author      Jakub Płaskonka <jplaskonka@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace ClassLockerBundle;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;

/**
 * Class ClassLockerBundle
 * @package ClassLockerBundle
 */
class ClassLockerBundle extends AbstractPimcoreBundle
{

    /**
     * @return array
     */
    public function getJsPaths()
    {
        return [
            '/bundles/classlocker/js/pimcore/startup.js',
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
