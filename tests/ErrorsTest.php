<?php

namespace Bilfeldt\LaravelFlashMessage\Tests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class ErrorsTest extends TestCase
{
    public function test_renders_default_error_bag()
    {
        View::share('errors', (new ViewErrorBag)->put('default', new MessageBag([
            'field_1' => 'Example message 1',
            'field_2' => ['Example message 2', 'Example message 3'],
        ])));

        $view = $this->blade('<x-flash::errors />');

        $view
            ->assertSee('role="alert"', false)
            ->assertSee('Example message 1')
            ->assertSee('Example message 2')
            ->assertSee('Example message 3');
    }

    public function test_renders_named_error_bag()
    {
        View::share('errors', (new ViewErrorBag)->put('foo', new MessageBag([
            'field_1' => 'Example message 1',
            'field_2' => ['Example message 2', 'Example message 3'],
        ])));

        $view = $this->blade('<x-flash::errors :bag="$bag" />', [
            'bag' => 'foo',
        ]);

        $view
            ->assertSee('role="alert"', false)
            ->assertSee('Example message 1')
            ->assertSee('Example message 2')
            ->assertSee('Example message 3');
    }

}
