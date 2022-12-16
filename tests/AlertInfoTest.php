<?php

namespace Bilfeldt\LaravelFlashMessage\Tests;

use Bilfeldt\LaravelFlashMessage\View\Components\AlertInfo;

class AlertInfoTest extends TestCase
{
    public function test_accessibility(): void
    {
        $view = $this->component(AlertInfo::class, [
            'text' => 'Example text',
        ]);

        $view->assertSee('role="alert"', false);
    }

    public function test_component_with_only_text(): void
    {
        $view = $this->component(AlertInfo::class, [
            'text' => 'Example text',
        ]);

        $view->assertSee('Example text');
    }

    public function test_component_with_title(): void
    {
        $view = $this->component(AlertInfo::class, [
            'text' => 'Example text',
            'title' => 'Example Title',
        ]);

        $view
            ->assertSee('Example text')
            ->assertSee('Example Title');
    }

    public function test_component_with_messages(): void
    {
        $view = $this->component(AlertInfo::class, [
            'text' => 'Example text',
            'messages' => [
                'field_1' => 'Example message 1',
                'field_2' => 'Example message 2',
            ],
        ]);

        $view
            ->assertSee('Example text')
            ->assertSee('Example message 1')
            ->assertSee('Example message 2');
    }

    public function test_component_with_links(): void
    {
        $view = $this->component(AlertInfo::class, [
            'text' => 'Example text',
            'links' => [
                'Link 1' => 'https://example.com/test1',
                'Link 2' => 'https://example.com/test2',
            ],
        ]);

        $view
            ->assertSee('Example text')
            ->assertSee('Link 1')
            ->assertSee('https://example.com/test1')
            ->assertSee('Link 2')
            ->assertSee('https://example.com/test2');
    }

    public function test_can_render_with_only_text(): void
    {
        $view = $this->blade(
            '<x-flash-alert-info :text="$text" />',
            ['text' => 'Example text']
        );

        $view
            ->assertSee('role="alert"', false)
            ->assertSee('Example text');
    }

    public function test_can_render_with_title(): void
    {
        $view = $this->blade('<x-flash-alert-info :text="$text" :title="$title" />', [
            'text' => 'Example text',
            'title' => 'Example Title',
        ]);

        $view
            ->assertSee('role="alert"', false)
            ->assertSee('Example text')
            ->assertSee('Example Title');
    }

    public function test_can_render_with_messages(): void
    {
        $view = $this->blade('<x-flash-alert-info :text="$text" :messages="$messages" />', [
            'text' => 'Example text',
            'messages' => [
                'field_1' => 'Example message 1',
                'field_2' => 'Example message 2',
            ],
        ]);

        $view
            ->assertSee('role="alert"', false)
            ->assertSee('Example text')
            ->assertSee('Example message 1')
            ->assertSee('Example message 2');
    }

    public function test_can_render_with_links(): void
    {
        $view = $this->blade('<x-flash-alert-info :text="$text" :links="$links" />', [
            'text' => 'Example text',
            'links' => [
                'Link 1' => 'https://example.com/test1',
                'Link 2' => 'https://example.com/test2',
            ],
        ]);

        $view
            ->assertSee('role="alert"', false)
            ->assertSee('Example text')
            ->assertSee('Link 1')
            ->assertSee('https://example.com/test1')
            ->assertSee('Link 2')
            ->assertSee('https://example.com/test2');
    }
}
