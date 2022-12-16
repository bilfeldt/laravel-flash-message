<?php

namespace Bilfeldt\LaravelFlashMessage\View\Components;

use Illuminate\Support\MessageBag;
use Illuminate\View\Component;

class Errors extends Component
{
    public function __construct(
        public string $title = '',
        public string $text = '',
        public ?array $messages = null,
        public array $links = [],
        public string $bag = 'default'
    ) {
        //
    }

    public function hasMessages(): bool
    {
        return $this->messages !== null;
    }

    public function messageBag(): \Illuminate\Contracts\Support\MessageBag
    {
        return new MessageBag($this->messages);
    }

    public function render()
    {
        return view('flash-message::components.errors');
    }
}
