<?php

namespace SleepingOwl\Admin\KDI;

use Illuminate\Support\ServiceProvider;
use SleepingOwl\Admin\KDI\Console\Commands\PackagesListCommand;

class AssetsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('assets.packages', function ($app) {
            return new PackageManager();
        });

        $this->app->singleton('assets', function ($app) {
            return new Assets($app['assets.packages']);
        });

        $this->app->singleton('assets.meta', function ($app) {
            return new Meta($app['assets']);
        });

        $aliases = [
            'assets.meta'     => \SleepingOwl\Admin\KDI\Contracts\MetaInterface::class,
            'assets'          => \SleepingOwl\Admin\KDI\Contracts\AssetsInterface::class,
            'assets.packages' => \SleepingOwl\Admin\KDI\Contracts\PackageManagerInterface::class,
        ];

        foreach ($aliases as $key => $alias) {
            $this->app->alias($key, $alias);
        }

        $this->commands(PackagesListCommand::class);
    }

    /**
     * Get a list of files that should be compiled for the package.
     *
     * @return array
     */
    public static function compiles()
    {
        return [
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Contracts\MetaInterface.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Contracts\AssetsInterface.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Contracts\PackageManagerInterface.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Contracts\AssetElementInterface.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Contracts\PackageInterface.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Contracts\SocialMediaTagsInterface.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Traits\Groups.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Traits\Vars.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Traits\Packages.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Traits\Styles.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Traits\Scripts.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\AssetElement.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Css.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Javascript.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Html.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Meta.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Package.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\PackageManager.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Assets.php'),
            base_path('vendor\laravelrus\sleepingowl\src\KDI\Facades\Meta.php'),
        ];
    }
}
