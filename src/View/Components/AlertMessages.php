<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

use Illuminate\View\Component;

class AlertMessages extends Component
{
    public function render()
    {
        return view('flash-message::components.alert-messages');
    }
}
