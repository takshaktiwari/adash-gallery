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
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->loadViewComponentsAs('agallery', [
            View\Components\GalleryCard::class,
            View\Components\FeaturedGalleries::class,
        ]);

        Paginator::useBootstrap();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views'),
        ]);
    }
}
