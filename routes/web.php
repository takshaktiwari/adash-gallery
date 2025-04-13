<?php

use Illuminate\Support\Facades\Route;
use Takshak\Agallery\Http\Controllers\GalleryController;

if (config('agallery.routes', true)) {
    Route::middleware(['web'])->prefix('galleries')->name('galleries.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::get('groups', [GalleryController::class, 'groups'])->name('groups');
        Route::get('{gallery:slug}', [GalleryController::class, 'show'])->name('show');
    });
}
