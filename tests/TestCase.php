<?php

namespace Themesberg\FlowbiteBladeIcons\Tests;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Orchestra\Testbench\TestCase as Orchestra;
use Themesberg\FlowbiteBladeIcons\FlowbiteBladeIconsServiceProvider;

class TestCase extends Orchestra
{
    use InteractsWithViews;

    protected function getPackageProviders($app)
    {
        return [
            FlowbiteBladeIconsServiceProvider::class,
        ];
    }
}
