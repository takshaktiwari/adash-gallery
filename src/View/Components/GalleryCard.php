<?php

namespace Takshak\Agallery\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class GalleryCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $gallery)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return View::first([
            'components.galleries.gallery-card',
            'agallery::components.galleries.gallery-card'
        ]);
    }
}
