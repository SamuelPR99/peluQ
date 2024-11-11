<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ejemplo extends Component
{
    public $message;
    public $type;

    public function __construct($message, $type = 'info')
    {
        $this->message = $message;
        $this->type= $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ejemplo');
    }
}
