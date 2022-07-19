<?php

namespace Takshak\Agallery\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;
use Takshak\Agallery\Models\Gallery;

class FeaturedGalleries extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $galleries;
    public function __construct(public $lines = 1, public $items = 4, public $masonry = false)
    {
        if (!$this->masonry) {
            $this->masonry = (config('site.gallery.layout', 'masonry') == 'masonry') ? true : false;
        }
        if (request('layout') == 'masonry') {
            $this->masonry = true;
        }

        $this->galleries = Gallery::query()
            ->withCount('galleryItems')
            ->select('id', 'name', 'slug', 'image_sm', 'image_md')
            ->when(request()->get('search'), function ($query) {
                $query->where('name', 'LIKE', '%' . request()->get('search') . '%')
                    ->orWhere('description', 'LIKE', '%' . request()->get('search') . '%')
                    ->orWhere('slug', 'LIKE', '%' . request()->get('search') . '%');
            })
            ->active()->latest()
            ->featured()->limit($this->items)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->masonry) {
            return View::first([
                'components.galleries.featured-galleries_masonry',
                'agallery::components.galleries.featured-galleries_masonry'
            ]);
        }
        return View::first([
            'components.galleries.featured-galleries_grid',
            'agallery::components.galleries.featured-galleries_grid'
        ]);
    }
}
