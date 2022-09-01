<?php

namespace SleepingOwl\Admin\KDI\Facades;

use Illuminate\Support\Facades\Facade;

class PackageManager extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'assets.packages';
    }
}
