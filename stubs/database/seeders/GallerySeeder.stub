<?php

namespace Database\Seeders;

use Takshak\Agallery\Models\Gallery;
use Takshak\Agallery\Models\GalleryItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Takshak\Imager\Facades\Picsum;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gallery::factory(20)
            ->create()
            ->each(function ($gallery) {
                $imageName = Str::of(microtime())->slug('-')->append('.jpg');
                $basePath = 'gallery/' . $gallery->slug;

                $image_lg = $imageName;
                $image_md = 'md/'.$imageName;
                $image_sm = 'sm/'.$imageName;

                $w = rand(6, 12)*100;
                $h = rand(6, 12)*100;
                Picsum::dimensions($w, $h)
                    ->basePath(Storage::disk('public')->path($basePath))
                    ->save($image_lg)
                    ->save($image_md, $w/2)
                    ->save($image_sm, $w/3)
                    ->destroy();

                $gallery->image_lg = $basePath.'/'.$image_lg;
                $gallery->image_md = $basePath.'/'.$image_md;
                $gallery->image_sm = $basePath.'/'.$image_md;
                $gallery->save();
            });

        GalleryItem::factory(250)
            ->create()
            ->each(function ($item) {
                $imageName = Str::of(microtime())->slug('-')->append('.jpg');
                $basePath = 'gallery-items';

                $image_lg = $imageName;
                $image_md = 'md/'.$imageName;
                $image_sm = 'sm/'.$imageName;

                $w = rand(6, 12)*100;
                $h = rand(6, 12)*100;

                Picsum::dimensions($w, $h)
                    ->basePath(Storage::disk('public')->path($basePath))
                    ->save($image_lg)
                    ->save($image_md, $w/2)
                    ->save($image_sm, $w/3)
                    ->destroy();

                $item->image_lg = $basePath.'/'.$image_lg;
                $item->image_md = $basePath.'/'.$image_md;
                $item->image_sm = $basePath.'/'.$image_md;

                $item->youtube_url = ($item->youtube_url == 'video')
                    ? 'https://www.youtube.com/watch?v=t0Q2otsqC4I'
                    : null;

                $item->save();

                $galleries = Gallery::inRandomOrder()->limit(rand(1, 4))->pluck('id')->toArray();
                $item->galleries()->sync($galleries);
            });
    }
}
