<?php

namespace Takshak\Agallery\View\Components\Agallery;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class GalleryCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $gallery, public $lines = 1, public $masonry = false)
    {
        if (!$this->masonry) {
            $this->masonry = (config('agallery.layout', 'masonry') == 'masonry') ? true : false;
        }
        if (request('layout') == 'masonry') {
            $this->masonry = true;
        }
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
                'components.galleries.gallery-card_masonry',
                'agallery::components.galleries.gallery-card_masonry'
            ]);
        }
        return View::first([
            'components.galleries.gallery-card_grid',
            'agallery::components.galleries.gallery-card_grid'
        ]);
    }
}
