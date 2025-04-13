<?php

namespace Takshak\Agallery\View\Components\Agallery;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class AdminSidebarLinks extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
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
            'components.galleries.admin-sidebar-links',
            'agallery::components.galleries.admin-sidebar-links'
        ]);
    }
}
