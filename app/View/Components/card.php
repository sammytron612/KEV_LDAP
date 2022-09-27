<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card extends Component
{

    public $title;
    public $text;
    public $image;
    public $route;
    public $width;

    public function __construct($title,$text,$image,$route,$width = 50)
    {
        $this->title = $title;
        $this->text = $text;
        $this->image = $image;
        $this->route = $route;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
