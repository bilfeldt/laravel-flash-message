<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

class AlertError extends AbstractAlert
{
    public function render()
    {
        return view('flash-message::components.alert-error');
    }
}
