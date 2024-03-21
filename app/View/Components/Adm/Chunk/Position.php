<?php

namespace App\View\Components\Adm\Chunk;

use App\Services\ChunkService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Position extends Component
{
    public $chunks;

    /**
     * Create a new component instance.
     */
    public function __construct(string $position)
    {
        $this->chunks = ChunkService::getAllByPosition($position);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.adm.chunk.position');
    }
}
