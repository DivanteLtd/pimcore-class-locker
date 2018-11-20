<?php
/**
 * @category    DivanteClassLocker
 * @date        19/11/2018 15:56
 * @author      Korneliusz Kirsz <kkirsz@divante.co>
 * @copyright   Copyright (c) 2018 Divante Ltd. (https://divante.co)
 */

namespace ClassLockerBundle\Service;

use ClassLockerBundle\ClassLockerBundle;

/**
 * Class ConfigService
 * @package ClassLockerBundle\Service
 */
class ConfigService
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @return array
     */
    public function getLockedClasses(): array
    {
        if ($this->config === null) {
            if (!file_exists(ClassLockerBundle::CONFIG_FILE)) {
                throw new \UnexpectedValueException(sprintf(
                    '%s doesn\'t exist',
                    ClassLockerBundle::CONFIG_FILE
                ));
            }

            $this->config = include ClassLockerBundle::CONFIG_FILE;
        }

        return $this->config;
    }
}
