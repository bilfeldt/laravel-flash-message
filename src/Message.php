<?php

namespace Bilfeldt\LaravelFlashMessage;

use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

class Message
{
    const LEVEL_MESSAGE = 'message';
    const LEVEL_INFO = 'info';
    const LEVEL_SUCCESS = 'success';
    const LEVEL_WARNING = 'warning';
    const LEVEL_ERROR = 'error';

    protected string $level;
    protected string $message;
    protected string $title;
    protected MessageBag $messageBag;
    protected array $links;

    public static function levels(): array
    {
        return [
            self::LEVEL_MESSAGE,
            self::LEVEL_INFO,
            self::LEVEL_SUCCESS,
            self::LEVEL_WARNING,
            self::LEVEL_ERROR,
        ];
    }

    public static function make(string $message): self
    {
        return new self($message);
    }

    public function __construct(string $message)
    {
        $this->level = self::LEVEL_MESSAGE;
        $this->message($message);
        $this->title = '';
        $this->links = [];
        $this->messageBag = new MessageBag();
    }

    //======================================================================
    // SETTERS
    //======================================================================

    public function info(): self
    {
        return $this->level(self::LEVEL_INFO);
    }

    public function success(): self
    {
        return $this->level(self::LEVEL_SUCCESS);
    }

    public function warning(): self
    {
        return $this->level(self::LEVEL_WARNING);
    }

    public function error(): self
    {
        return $this->level(self::LEVEL_ERROR);
    }

    public function level(string $level): self
    {
        if (! in_array($level, self::levels())) {
            throw new \DomainException("Invalid message level: $level");
        }

        $this->level = $level;

        return $this;
    }

    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function errors(array $errors): self
    {
        $this->messageBag = new MessageBag($errors);

        return $this;
    }

    public function addError(string $field, string ...$errors): self
    {
        $this->messageBag->merge(empty($errors) ? [$field] : [$field => $errors]);

        return $this;
    }

    public function addLink(string $text, string $url): self
    {
        $this->links[$text] = $url;

        return $this;
    }

    public function links(array $links): self
    {
        foreach ($links as $text => $url) {
            $this->addLink($text, $url);
        }

        return $this;
    }

    //======================================================================
    // GETTERS
    //======================================================================

    public function getLevel(): string
    {
        return $this->level;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMessageBag(): MessageBag
    {
        return $this->messageBag;
    }

    public function getLinks(): array
    {
        return $this->links;
    }

    public function toArray(): array
    {
        return [
            'level' => $this->level,
            'title' => $this->title,
            'message' => $this->message,
            'messageBag' => $this->messageBag,
            'links' => $this->links,
        ];
    }

    //======================================================================
    // METHODS
    //======================================================================

    public function flash(): void
    {
        session()->flash(config('flash-message.session_flash').'.'.Str::orderedUuid(), $this);
    }
}
