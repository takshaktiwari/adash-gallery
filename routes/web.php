<?php

use Illuminate\Support\Facades\Route;
use Takshak\Agallery\Http\Controllers\GalleryController;

if (config('site.gallery.routes', true)) {
    Route::middleware(['web'])->prefix('galleries')->name('galleries.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::get('{gallery:slug}', [GalleryController::class, 'show'])->name('show');
    });
}
