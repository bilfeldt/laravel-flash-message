<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

use Illuminate\View\Component;

class Errors extends Component
{
    public function __construct(
        public string $title = '',
        public string $text = '',
        public array $links = [],
        public string $bag = 'default',
        public ?string $format = null,
    ) {
        //
    }

    public function render()
    {
        return view('flash::components.errors');
    }
}
