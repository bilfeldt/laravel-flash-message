<?php

namespace Bilfeldt\LaravelFlashMessage\Tests;

use Bilfeldt\LaravelFlashMessage\Message;
use Bilfeldt\LaravelFlashMessage\View\Components\Alert;

class AlertTest extends \Bilfeldt\LaravelFlashMessage\Tests\TestCase
{
    public function provideLevels()
    {
        return [
            [Message::LEVEL_MESSAGE],
            [Message::LEVEL_SUCCESS],
            [Message::LEVEL_INFO],
            [Message::LEVEL_WARNING],
            [Message::LEVEL_ERROR],
        ];
    }

    /**
     * @dataProvider provideLevels
     */
    public function test_can_show_message(string $level): void
    {
        $view = $this->component(Alert::class, [
            'text' => 'Example text',
            'level' => $level,
        ]);

        $view->assertSee('role="alert"', false);
    }

    /**
     * @dataProvider provideLevels
     */
    public function test_can_render_message(string $level): void
    {
        $view = $this->blade('<x-flash::alert :level="$level" :text="$text" />', [
            'level' => $level,
            'text' => 'Example text',
        ]);

        $view->assertSee('role="alert"', false);
    }
}
