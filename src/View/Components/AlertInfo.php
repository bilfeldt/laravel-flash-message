<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

class AlertInfo extends AbstractAlert
{
    public function render()
    {
        return view('flash::components.alert-info');
    }
}
