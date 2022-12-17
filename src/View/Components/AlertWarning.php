<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

class AlertWarning extends AbstractAlert
{
    public function render()
    {
        return view('flash-message::components.alert-warning');
    }
}
