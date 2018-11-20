<?php
/**
 * @category    ClassLocker
 * @date        19/11/2018 15:28
 * @author      Korneliusz Kirsz <kkirsz@divante.co>
 * @copyright   Copyright (c) 2018 Divante Ltd. (https://divante.co)
 */

namespace ClassLockerBundle;

use Doctrine\DBAL\Migrations\Version;
use Doctrine\DBAL\Schema\Schema;
use Pimcore\Extension\Bundle\Installer\MigrationInstaller;

/**
 * Class Installer
 * @package ClassLockerBundle
 */
class Installer extends MigrationInstaller
{
    /**
     * @param Schema $schema
     * @param Version $version
     */
    public function migrateInstall(Schema $schema, Version $version)
    {
        $dir = dirname(ClassLockerBundle::CONFIG_FILE);

        if (!file_exists($dir)) {
            \Pimcore\File::mkdir($dir);
            copy(__DIR__ . '/Resources/install/config.php', ClassLockerBundle::CONFIG_FILE);
        }
    }

    /**
     * @param Schema $schema
     * @param Version $version
     */
    public function migrateUninstall(Schema $schema, Version $version)
    {
    }
}
