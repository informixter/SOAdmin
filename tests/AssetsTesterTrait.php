<?php

namespace SleepingOwl\Tests;

trait AssetsTesterTrait
{
    public function packageIncluded()
    {
        \SleepingOwl\Admin\KDI\Facades\PackageManager::shouldReceive('load')->once();
        \SleepingOwl\Admin\KDI\Facades\PackageManager::shouldReceive('add')->once();
    }

    public function packageInitialized()
    {
        //\SleepingOwl\Admin\KDI\Facades\Meta::shouldReceive('loadPackage')->once();
    }
}
