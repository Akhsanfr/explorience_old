<?php

namespace App\View\Components\Sidebar;

use Illuminate\View\Component;

class Judul extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $icon, $link;

    public function __construct( $icon, $link )
    {
        $this->icon = $icon;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar.judul');
    }
}
