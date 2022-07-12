<?php

namespace Takshak\Agallery\Traits\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Takshak\Agallery\Actions\GalleryItemAction;
use Takshak\Agallery\Models\Gallery;
use Takshak\Agallery\Models\GalleryItem;

trait GalleryItemControllerTrait
{
    public function index(Request $request)
    {
        $galleryItems = GalleryItem::query()
            ->with(['galleries' => fn ($q) => $q->select('galleries.id', 'name')])
            ->when($request->get('gallery_id'), function($query) use($request){
                $query->whereHas('galleries', function($query) use($request){
                    $query->where('galleries.id', $request->get('gallery_id'));
                });
            })
            ->latest()
            ->paginate(25);
        return View::first(
            ['admin.galleries-items.index', 'agallery::admin.galleries-items.index'],
            compact('galleryItems')
        );
    }


    public function create()
    {
        $galleries = Gallery::select('id', 'name')->get();
        return View::first(
            ['admin.galleries-items.create', 'agallery::admin.galleries-items.create'],
            compact('galleries')
        );
    }

    public function store(Request $request, GalleryItemAction $action)
    {
        $request->validate([
            'title'         =>  'required',
            'description'   =>  'nullable|max:250',
            'galleries'     =>  'required|array|min:1',
            'galleries.*'   =>  'required|numeric',
            'item_type'     =>  'required|in:image,video',
            'status'        =>  'nullable|boolean',
            'youtube_url'   =>  'nullable|url',
            'image'         =>  'required|image',
        ]);

        $galleryItem = $action->save($request, new GalleryItem);
        return to_route('admin.galleries-items.index')->withSuccess('SUCCESS !! New gallery item has been added.');
    }

    public function destroy(GalleryItem $galleries_item)
    {
        Storage::disk('public')->delete([
            $galleries_item->image_lg,
            $galleries_item->image_md,
            $galleries_item->image_sm
        ]);
        $galleries_item->delete();
        return to_route('admin.galleries-items.index')->withSuccess('SUCCESS !! Gallery item has been successfully deleted.');
    }
}
