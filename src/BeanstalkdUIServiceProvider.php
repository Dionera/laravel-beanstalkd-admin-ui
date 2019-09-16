<?php

namespace Dionera\BeanstalkdUI;

use Pheanstalk\Pheanstalk;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Pheanstalk\Contract\PheanstalkInterface;
use Dionera\BeanstalkdUI\ViewComposers\LayoutComposer;

class BeanstalkdUIServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/Resources/config/beanstalkdui.php', 'beanstalkdui');

        $this->app->bind(PheanstalkInterface::class, function () {
            return Pheanstalk::create(
                config('beanstalkdui.host'),
                config('beanstalkdui.port')
            );
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @param Router $router
     */
    public function boot(Router $router)
    {
        $this->publishAssets();
        $this->registerRoutes($router);
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'beanstalkdui');
        $this->registerViewComposer();
    }

    /**
     * @param Router $router
     */
    private function registerRoutes(Router $router)
    {
        if (!$this->app->routesAreCached()) {
            $router->group([
                'middleware' => config('beanstalkdui.middleware'),
                'prefix' => config('beanstalkdui.prefix')
            ], function ($router) {
                require __DIR__.'/routes.php';
            });
        }
    }

    private function publishAssets()
    {
        $this->publishes([
            __DIR__.'/Resources/assets/css' => public_path('vendor/beanstalkdui/css'),
            __DIR__.'/Resources/assets/js' => public_path('vendor/beanstalkdui/js'),
            __DIR__.'/Resources/assets/fonts' => public_path('vendor/beanstalkdui/fonts'),
        ], 'public');

        $this->publishes([
            __DIR__.'/Resources/config/beanstalkdui.php' => config_path('beanstalkdui.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/Resources/views' => resource_path('views/vendor/beanstalkdui'),
        ]);
    }

    private function registerViewComposer()
    {
        view()->composer('beanstalkdui::partials.sidenav', LayoutComposer::class);
    }
}
