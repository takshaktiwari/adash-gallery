<?php

use Takshak\Adash\Http\Middleware\GatesMiddleware;
use Illuminate\Support\Facades\Route;
use Takshak\Adash\Http\Middleware\ReferrerMiddleware;
use Takshak\Agallery\Http\Controllers\Admin\GalleryController;
use Takshak\Agallery\Http\Controllers\Admin\GalleryItemController;

Route::middleware(['web', 'auth', GatesMiddleware::class, ReferrerMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('galleries', GalleryController::class);
    Route::resource('galleries-items', GalleryItemController::class);
});
