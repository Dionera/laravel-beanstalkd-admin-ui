<?php

namespace Dionera\BeanstalkdUI;

use Pheanstalk\Pheanstalk;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Pheanstalk\Contract\PheanstalkInterface;
use Dionera\BeanstalkdUI\ViewComposers\LayoutComposer;

class BeanstalkdUIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/Resources/config/beanstalkdui.php', 'beanstalkdui');

        $this->app->bind(PheanstalkInterface::class, function () {
            return Pheanstalk::create(
                config('beanstalkdui.host'),
                config('beanstalkdui.port')
            );
        });
    }

    public function boot(Router $router): void
    {
        $this->publishAssets();
        $this->registerRoutes($router);
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'beanstalkdui');
        $this->registerViewComposer();
    }

    private function registerRoutes(Router $router): void
    {
        if (!$this->app->routesAreCached()) {
            $router->group([
                'middleware' => config('beanstalkdui.middleware'),
                'prefix' => config('beanstalkdui.prefix')
            ], function () {
                require __DIR__.'/routes.php';
            });
        }
    }

    private function publishAssets(): void
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

    private function registerViewComposer(): void
    {
        view()->composer('beanstalkdui::partials.sidenav', LayoutComposer::class);
    }
}
