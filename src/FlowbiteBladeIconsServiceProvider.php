<?php

declare(strict_types=1);

namespace Themesberg\FlowbiteBladeIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class FlowbiteBladeIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('flowbite-blade-icons', []);

            $factory->add('flowbiteicons', array_merge(['path' => __DIR__.'/../resources/svg'], $config));
            //             Extra prefix
            $factory->add('flowbite-icons', array_merge([
                'path' => __DIR__.'/../resources/svg'],
                collect($config)->put('prefix', 'fwb')->toArray()
            ));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/flowbite-blade-icons.php', 'flowbite-blade-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/flowbite-blade-icons'),
            ], 'flowbite-blade-icons');

            $this->publishes([
                __DIR__.'/../config/flowbite-blade-icons.php' => $this->app->configPath('flowbite-blade-icons.php'),
            ], 'flowbite-blade-icons-config');
        }
    }
}
