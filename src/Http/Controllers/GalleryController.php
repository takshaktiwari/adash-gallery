<?php

namespace Takshak\Agallery\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Takshak\Agallery\Models\Gallery;
use Illuminate\Support\Facades\View;
use Takshak\Agallery\Models\GalleryItem;

class GalleryController extends Controller
{
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
            ->active()->latest()->paginate(12)->withQueryString();

        $featuredGalleries = $this->_getFeaturedGalleries();

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

        $featuredGalleries = $this->_getFeaturedGalleries();
        return View::first(
            ['galleries.show', 'agallery::galleries.show'],
            compact('gallery', 'galleryItems', 'featuredGalleries')
        );
    }

    public function _getFeaturedGalleries($limit = 3)
    {
        return Gallery::query()
            ->withCount('galleryItems')
            ->select('id', 'name', 'slug', 'image_sm', 'image_md')
            ->when(request()->get('search'), function ($query) {
                $query->where('name', 'LIKE', '%' . request()->get('search') . '%')
                    ->orWhere('description', 'LIKE', '%' . request()->get('search') . '%')
                    ->orWhere('slug', 'LIKE', '%' . request()->get('search') . '%');
            })
            ->active()->latest()
            ->featured()->limit($limit)->get();
    }
}
