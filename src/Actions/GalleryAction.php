<?php

namespace Takshak\Agallery\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Takshak\Imager\Facades\Imager;

class GalleryAction
{
    public function save($request, $gallery)
    {
        $gallery->name = $request->post('name');
        $gallery->slug = Str::of($gallery->name)->slug('-')->append(time());
        $gallery->description = $request->post('description');
        $gallery->status = $request->post('status');
        $gallery->featured = $request->post('featured');
        $gallery->item_img_width = $request->post('item_img_width');
        $gallery->item_img_height = $request->post('item_img_height');
        $gallery->user_id = auth()->id();

        if ($request->file('image')) {
            $imageName = Str::of(microtime())->slug('-')->append('.jpg');
            $basePath = 'gallery/' . $gallery->slug;

            $image_lg = $imageName;
            $image_md = 'md/'.$imageName;
            $image_sm = 'sm/'.$imageName;

            Imager::init($request->file('image'))
                ->resizeFit(
                    config('agallery.cover_image.large', 1000),
                    config('agallery.cover_image.large', 600)
                )
                ->basePath(Storage::disk('public')->path($basePath))
                ->save($image_lg)
                ->save($image_md, config('agallery.cover_image.medium', 500))
                ->save($image_sm, config('agallery.cover_image.small', 300));

            $gallery->image_lg = $basePath.'/'.$image_lg;
            $gallery->image_md = $basePath.'/'.$image_md;
            $gallery->image_sm = $basePath.'/'.$image_md;
        }

        $gallery->save();
        return $gallery;
    }
}
