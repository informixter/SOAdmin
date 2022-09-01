<?php

namespace SleepingOwl\Admin\KDI\Contracts;

use SleepingOwl\Admin\KDI\Package;

interface PackageManagerInterface
{
    /**
     * @param string|Package $package
     *
     * @return Package
     */
    public function add($package);

    /**
     * @param string $name
     *
     * @return Package|null
     */
    public function load($name);
}
