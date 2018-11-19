<?php
/**
 * @category    ClassLocker
 * @date        22/10/2017 10:39
 * @author      Jakub Płaskonka <jplaskonka@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace ClassLockerBundle;

use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;
use Pimcore\Extension\Bundle\AbstractPimcoreBundle;

/**
 * Class ClassLockerBundle
 * @package ClassLockerBundle
 */
class ClassLockerBundle extends AbstractPimcoreBundle
{
    const CONFIG_DIR = PIMCORE_CUSTOM_CONFIGURATION_DIRECTORY . '/classlocker';

    use PackageVersionTrait;

    /**
     * @return string
     */
    public function getComposerPackageName(): string
    {
        return 'divanteltd/pimcore-class-locker';
    }

    /**
     * @inheritdoc
     */
    public function getNiceName()
    {
        return "Divante Class Locker";
    }

    /**
     * @return Installer
     */
    public function getInstaller()
    {
        return $this->container->get(Installer::class);
    }

    /**
     * @return array
     */
    public function getJsPaths()
    {
        return [
            '/bundles/classlocker/js/pimcore/startup.js',
        ];
    }
}
