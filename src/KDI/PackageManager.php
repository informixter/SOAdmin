<?php

namespace SleepingOwl\Admin\KDI;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\KDI\Contracts\PackageInterface;
use SleepingOwl\Admin\KDI\Contracts\PackageManagerInterface;

class PackageManager extends Collection implements PackageManagerInterface
{
    /**
     * @param string|PackageInterface $package
     *
     * @return Package
     */
    public function add($package)
    {
        if ((!$package instanceof PackageInterface)) {
            $name = $package;
            $package = Package::create($name);
        }

        $this->put($package->getName(), $package);

        return $package;
    }

    /**
     * @param string $name
     *
     * @return PackageInterface|null
     */
    public function load($name)
    {
        return $this->get($name);
    }
}
