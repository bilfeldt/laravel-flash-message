<?php

namespace Bilfeldt\LaravelFlashMessage\Tests;

use Bilfeldt\LaravelFlashMessage\FlashMessageServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use InteractsWithViews;

    protected function getPackageProviders($app)
    {
        return [
            FlashMessageServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
