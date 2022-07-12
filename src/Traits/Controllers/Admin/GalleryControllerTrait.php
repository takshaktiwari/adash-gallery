<?php

namespace Takshak\Agallery\Traits\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Takshak\Agallery\Models\Gallery;

trait GalleryControllerTrait
{
    public function index()
    {
        $galleries = Gallery::withCount('galleryItems')->latest()->get();
        return View::first(
            ['admin.galleries.index', 'agallery::admin.galleries.index'],
            compact('galleries')
        );
    }
}
