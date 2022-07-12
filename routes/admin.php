<?php

use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GalleryItemController;
use Takshak\Adash\Http\Middleware\RefererMiddleware;
use Takshak\Adash\Http\Middleware\GatesMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', GatesMiddleware::class, RefererMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('galleries', GalleryController::class);
    Route::resource('galleries-items', GalleryItemController::class);
});
