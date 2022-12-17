<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

class AlertMessage extends AbstractAlert
{
    public function render()
    {
        return view('flash-message::components.alert-message');
    }
}
