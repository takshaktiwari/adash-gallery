<?php

namespace Takshak\Agallery;

use Illuminate\Support\ServiceProvider;
use Takshak\Agallery\Console\InstallCommand;
use Illuminate\Pagination\Paginator;

class AgalleryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([ InstallCommand::class ]);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agallery');
        /* $this->loadViewComponentsAs('agallery', [
            View\Components\Agallery::class,
        ]); */

        Paginator::useBootstrap();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views'),
        ]);
    }
}
