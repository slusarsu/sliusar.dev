<?php

namespace App\View\Components;

use App\Services\MenuService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * @var array|\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
     */
    public mixed $links;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->links = MenuService::links('C79aWfsC3xCjPD1');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
