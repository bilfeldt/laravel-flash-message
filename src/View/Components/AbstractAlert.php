<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

use Illuminate\View\Component;

abstract class AbstractAlert extends Component
{
    public string $text;
    public string $title;
    public array $messages;
    public array $links;

    public function __construct(string $text = '', string $title = '', array $messages = [], array $links = [])
    {
        $this->text = $text;
        $this->title = $title;
        $this->messages = $messages;
        $this->links = $links;
    }
}
