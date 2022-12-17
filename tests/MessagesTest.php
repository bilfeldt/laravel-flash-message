<?php

namespace Bilfeldt\LaravelFlashMessage\Tests;

use Bilfeldt\LaravelFlashMessage\Message;
use Bilfeldt\LaravelFlashMessage\View\Components\Messages;

class MessagesTest extends TestCase
{
    public function test_can_show_message_from_default_bag(): void
    {
        \Illuminate\Support\Facades\View::withMessages([
            Message::make('Test message'),
            Message::info('Test info'),
            Message::success('Test success'),
            Message::warning('Test warning'),
            Message::error('Test error'),
        ]);

        $view = $this->component(Messages::class);

        $view
            ->assertSee('role="alert"', false)
            ->assertSee('Test message')
            ->assertSee('Test info')
            ->assertSee('Test success')
            ->assertSee('Test warning')
            ->assertSee('Test error');
    }

    public function test_can_show_message_from_named_bag(): void
    {
        \Illuminate\Support\Facades\View::withMessages([
            Message::make('Test message'),
            Message::info('Test info'),
            Message::success('Test success'),
            Message::warning('Test warning'),
            Message::error('Test error'),
        ], 'non-default');

        $view = $this->component(Messages::class, [
            'bag' => 'non-default',
        ]);

        $view
            ->assertSee('role="alert"', false)
            ->assertSee('Test message')
            ->assertSee('Test info')
            ->assertSee('Test success')
            ->assertSee('Test warning')
            ->assertSee('Test error');
    }
}
