<?php

namespace Bilfeldt\LaravelFlashMessage\Tests;

use Illuminate\Support\Facades\View;
use Illuminate\Testing\TestView;

class ViewMacroTest extends TestCase
{
    public function test_add_errors(): void
    {
        $this->withViewErrors([
            'name' => ['Please provide a valid name.'],
        ]);

        $view = new TestView(view('flash::test')->addErrors([
            'email' => ['Invalid email'],
        ]));

        $this->assertEquals([
            'name' => [
                'Please provide a valid name.',
            ],
            'email' => [
                'Invalid email',
            ],
        ], View::shared('errors')->toArray());

        $view
            ->assertSee('Please provide a valid name.')
            ->assertSee('Invalid email');
    }
}
