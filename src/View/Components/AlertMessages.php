<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

use Illuminate\View\Component;

class AlertMessages extends Component
{
    public string $bag;

    public function __construct(string $bag = 'default')
    {
        $this->bag = $bag;
    }

    public function render()
    {
        return view('flash-message::components.alert-messages');
    }
}
