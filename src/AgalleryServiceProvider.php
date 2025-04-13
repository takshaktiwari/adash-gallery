<?php

namespace Takshak\Agallery;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AgalleryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewComponentsAs('agallery', [
            View\Components\Agallery\GalleryCard::class,
            View\Components\Agallery\FeaturedGalleries::class,
            View\Components\Agallery\AdminSidebarLinks::class
        ]);
        Paginator::useBootstrap();


        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agallery');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');

        $this->publishes([
            __DIR__.'/../config/agallery.php' => config_path('agallery.php'),
        ], 'agallery-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views'),
        ], 'agallery-views');

        $this->publishes([
            __DIR__.'/../database/factories' => database_path('factories'),
            __DIR__.'/../database/seeders' => database_path('seeders'),
        ], 'agallery-seeders');
    }
}
