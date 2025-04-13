<?php

namespace Takshak\Agallery\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Takshak\Agallery\Actions\GalleryAction;
use Takshak\Agallery\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::withCount('galleryItems')->latest()->get();
        return View::first(
            ['admin.galleries.index', 'agallery::admin.galleries.index'],
            compact('galleries')
        );
    }

    public function create()
    {
        return View::first(
            ['admin.galleries.create', 'agallery::admin.galleries.create'],
        );
    }

    public function store(Request $request, GalleryAction $action)
    {
        $request->validate([
            'name'          =>  'required',
            'description'   =>  'nullable|max:250',
            'status'        =>  'nullable|boolean',
            'featured'      =>  'nullable|boolean',
            'image'             =>  'nullable|image',
            'item_img_width'    =>  'required|numeric',
            'item_img_height'   =>  'required|numeric',
        ]);

        $gallery = $action->save($request, new Gallery);
        return to_route('admin.galleries.show', [$gallery])->withSuccess('New Gallery has been successfully added.');
    }

    public function show(Gallery $gallery)
    {
        return View::first(
            ['admin.galleries.show', 'agallery::admin.galleries.show'],
            compact('gallery')
        );
    }

    public function edit(Gallery $gallery)
    {
        return View::first(
            ['admin.galleries.edit', 'agallery::admin.galleries.edit'],
            compact('gallery')
        );
    }

    public function update(Gallery $gallery, Request $request, GalleryAction $action)
    {
        $request->validate([
            'name'          =>  'required',
            'description'   =>  'nullable|max:250',
            'status'        =>  'nullable|boolean',
            'featured'      =>  'nullable|boolean',
            'image'             =>  'nullable|image',
            'item_img_width'    =>  'required|numeric',
            'item_img_height'   =>  'required|numeric',
        ]);

        $gallery = $action->save($request, $gallery);
        return to_route('admin.galleries.show', [$gallery])->withSuccess('Gallery has been successfully updated.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')
            ->delete([
                $gallery->image_sm,
                $gallery->image_md,
                $gallery->image_lg
            ]);
        $gallery->delete();
        return to_route('admin.galleries.index')->withSuccess('SUCCESS !! Gallery has been deleted.');
    }
}
