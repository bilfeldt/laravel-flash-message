<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

use Bilfeldt\LaravelFlashMessage\Message;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $level;
    public string $text;
    public string $title;
    public array $messages;
    public array $links;

    public function __construct(string $text, string $title = '', array $messages = [], array $links = [], string $level = Message::LEVEL_MESSAGE)
    {
        $this->level = $level;
        $this->text = $text;
        $this->title = $title;
        $this->messages = $messages;
        $this->links = $links;
    }

    public function render()
    {
        return view('flash-message::components.alert');
    }
}
