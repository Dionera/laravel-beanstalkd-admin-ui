<?php

namespace Sassnowski\BeanstalkdUI;

use Illuminate\Support\ServiceProvider;
use Pheanstalk\Pheanstalk;
use Pheanstalk\PheanstalkInterface;
use Sassnowski\BeanstalkdUI\ViewComposers\LayoutComposer;

class BeanstalkdUIServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind(PheanstalkInterface::class, function () {
            return new Pheanstalk(
                config('beanstalkdui.host'),
                config('beanstalkdui.port')
            );
        });
    }

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        $this->loadViewsFrom(__DIR__.'/Resources/views', 'beanstalkdui');
        $this->registerViewComposer();
        $this->publishAssets();
    }

    private function publishAssets()
    {
        $this->publishes([
            __DIR__.'/Resources/assets/css' => public_path('vendor/beanstalkdui/css'),
            __DIR__.'/Resources/assets/js' => public_path('vendor/beanstalkdui/js'),
            __DIR__.'/Resources/assets/fonts' => public_path('vendor/beanstalkdui/fonts'),
            __DIR__.'/Resources/config/beanstalkdui.php' => config_path('beanstalkdui.php'),
        ], 'public');
    }

    private function registerViewComposer()
    {
        view()->composer('beanstalkdui::partials.sidenav', LayoutComposer::class);
    }
}
