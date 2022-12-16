<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

class AlertSuccess extends AbstractAlert
{
    public function render()
    {
        return view('flash-message::components.alert-success');
    }
}
