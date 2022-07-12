<?php

namespace Takshak\Agallery\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Takshak\Agallery\Models\Gallery;
use Takshak\Imager\Facades\Imager;

class GalleryItemAction
{
    public function save($request, $galleryItem)
    {
        $galleryItem->title = $request->post('title');
        $galleryItem->description = $request->post('description');
        $galleryItem->item_type = $request->post('item_type');
        $galleryItem->status = $request->boolean('status');
        $galleryItem->youtube_url = $request->post('youtube_url');
        $galleryItem->user_id = auth()->id();

        if ($request->file('image')) {
            $gallery = Gallery::where('id', $request->post('galleries')[0])->first();

            $imageName = Str::of(microtime())->slug('-')->append('.jpg');
            $basePath = 'gallery-items';

            $image_lg = $imageName;
            $image_md = 'md/'.$imageName;
            $image_sm = 'sm/'.$imageName;

            Imager::init($request->file('image'))
                ->resizeFit(
                    $gallery->item_img_width,
                    $gallery->item_img_height
                )
                ->basePath(Storage::disk('public')->path($basePath))
                ->save($image_lg)
                ->save($image_md, ceil($gallery->item_img_width/2))
                ->save($image_sm, ceil($gallery->item_img_width/3));

            $galleryItem->image_lg = $basePath.'/'.$image_lg;
            $galleryItem->image_md = $basePath.'/'.$image_md;
            $galleryItem->image_sm = $basePath.'/'.$image_md;
        }

        $galleryItem->save();
        $galleryItem->galleries()->sync($request->post('galleries'));

        return $galleryItem;
    }
}
