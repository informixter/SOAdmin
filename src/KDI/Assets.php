<?php

namespace SleepingOwl\Admin\KDI;

use SleepingOwl\Admin\KDI\Contracts\AssetElementInterface;
use SleepingOwl\Admin\KDI\Contracts\AssetsInterface;
use SleepingOwl\Admin\KDI\Contracts\PackageManagerInterface;

class Assets implements AssetsInterface
{
    use \SleepingOwl\Admin\KDI\Traits\Groups,
        \SleepingOwl\Admin\KDI\Traits\Vars,
        \SleepingOwl\Admin\KDI\Traits\Packages;

    /**
     * @var PackageManagerInterface
     */
    protected $manager;

    /**
     * Assets constructor.
     *
     * @param PackageManagerInterface $manager
     */
    public function __construct(PackageManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return PackageManagerInterface
     */
    public function packageManager()
    {
        return $this->manager;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->removeCss();
        $this->removeJs();
        $this->removeGroup();
        $this->removePackages();
        $this->removeVars();

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->renderStyles()
        .PHP_EOL.$this->renderVars()
        .PHP_EOL.$this->renderScripts();
    }

    /**
     * Sorts assets based on dependencies.
     *
     * @param AssetElementInterface[] $assets Array of assets
     *
     * @return AssetElementInterface[] Sorted array of assets
     */
    protected function sort($assets)
    {
        $original = $assets;
        $sorted = [];

        while (count($assets) > 0) {
            foreach ($assets as $handle => $asset) {
                // No dependencies anymore, add it to sorted
                if (!$asset->hasDependency()) {
                    $sorted[$handle] = $asset;
                    unset($assets[$handle]);
                } else {
                    foreach ($asset->getDependency() as $dep) {
                        // Remove dependency if doesn't exist, if its dependent on itself,
                        // or if the dependent is dependent on it
                        if (!isset($original[$dep]) or $dep === $handle or (isset($assets[$dep]) and $assets[$dep]->hasDependency($handle))) {
                            $assets[$handle]->removeDependency($dep);
                            continue;
                        }

                        // This dependency hasn't been sorted yet
                        if (!isset($sorted[$dep])) {
                            continue;
                        }

                        // This dependency is taken care of, remove from list
                        $assets[$handle]->removeDependency($dep);
                    }
                }
            }
        }

        return $sorted;
    }
}
