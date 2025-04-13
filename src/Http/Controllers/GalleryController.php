<?php

namespace Takshak\Agallery\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Takshak\Agallery\Models\Gallery;
use Illuminate\Support\Facades\View;
use Takshak\Agallery\Models\GalleryItem;

class GalleryController extends Controller
{
    public $masonry = false;

    public function __construct(Request $request)
    {
        $this->masonry = (config('agallery.layout', 'masonry') == 'masonry') ? true : false;
        if ($request->get('layout') == 'masonry') {
            $this->masonry = true;
        }
    }

    public function index(Request $request)
    {
        $otherGalleries = Gallery::query()
            ->withCount('galleryItems')
            ->select('id', 'name', 'slug', 'image_sm', 'image_md')
            ->when($request->get('search'), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhere('slug', 'LIKE', '%' . $request->get('search') . '%');
            })
            ->where('featured', false)
            ->active()->latest()->paginate(16)->withQueryString();

        if ($this->masonry) {
            return View::first(
                ['galleries.index_masonry', 'agallery::galleries.index_masonry'],
                compact('otherGalleries')
            );
        }

        return View::first(
            ['galleries.index_grid', 'agallery::galleries.index_grid'],
            compact('featuredGalleries', 'otherGalleries')
        );
    }

    public function show(Gallery $gallery, Request $request)
    {
        $galleryItems = GalleryItem::query()
            ->whereHas('galleries', fn ($q) => $q->where('galleries.id', $gallery->id))
            ->paginate(20)
            ->withQueryString();

        if ($this->masonry) {
            return View::first(
                ['galleries.show_masonry', 'agallery::galleries.show_masonry'],
                compact('gallery', 'galleryItems')
            );
        }

        return View::first(
            ['galleries.show_grid', 'agallery::galleries.show_grid'],
            compact('gallery', 'galleryItems', 'featuredGalleries')
        );
    }

    public function groups(Request $request)
    {
        $galleries = Gallery::query()
            ->withCount('galleryItems')
            ->select('id', 'name', 'slug', 'description')
            ->when($request->get('search'), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhere('slug', 'LIKE', '%' . $request->get('search') . '%');
            })
            ->active()
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $masonry = false;
        if ((config('agallery.layout', 'masonry') == 'masonry') || request('layout') == 'masonry') {
            $masonry = true;
        }
        return View::first(
            ['galleries.groups', 'agallery::galleries.groups'],
            compact('galleries', 'masonry')
        );
    }
}
