<?php

namespace GMJ\LaravelBlock2Breadcrumb;

use GMJ\LaravelBlock2Breadcrumb\View\Components\Frontend;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelBlock2BreadcrumbServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php", 'LaravelBlock2Breadcrumb');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'LaravelBlock2Breadcrumb');

        Blade::component("LaravelBlock2Breadcrumb", Frontend::class);
        $this->publishes([
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'GMJ\LaravelBlock2Breadcrumb');
    }

    public function register()
    {
    }
}
