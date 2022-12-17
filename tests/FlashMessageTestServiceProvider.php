<?php

namespace Bilfeldt\LaravelFlashMessage\Tests;

use Illuminate\Support\ServiceProvider;

class FlashMessageTestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Fixtures/resources/views', 'flash');
    }
}
