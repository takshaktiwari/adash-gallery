<?php


use Illuminate\Support\Facades\Route;
use Takshak\Adash\Http\Middleware\GatesMiddleware;
use Takshak\Adash\Http\Middleware\ReferrerMiddleware;
use Takshak\Agallery\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use Takshak\Agallery\Http\Controllers\GalleryController;
use Takshak\Agallery\Http\Controllers\Admin\GalleryItemController;

Route::middleware(['web', 'auth', GatesMiddleware::class, ReferrerMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('galleries', AdminGalleryController::class);
        Route::resource('galleries-items', GalleryItemController::class);
    });

if (config('agallery.routes', true)) {
    Route::middleware(['web'])->prefix('galleries')->name('galleries.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::get('groups', [GalleryController::class, 'groups'])->name('groups');
        Route::get('{gallery:slug}', [GalleryController::class, 'show'])->name('show');
    });
}
