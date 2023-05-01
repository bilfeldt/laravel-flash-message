<?php

namespace Bilfeldt\LaravelFlashMessage;

use Illuminate\Support\MessageBag;

class Message
{
    public const LEVEL_MESSAGE = 'message';
    public const LEVEL_INFO = 'info';
    public const LEVEL_SUCCESS = 'success';
    public const LEVEL_WARNING = 'warning';
    public const LEVEL_ERROR = 'error';

    protected string $level;
    protected string $text;
    protected string $title;
    protected MessageBag $messages;
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

    public static function info(string $text): self
    {
        return self::make($text)->level(self::LEVEL_INFO);
    }

    public static function success(string $text): self
    {
        return self::make($text)->level(self::LEVEL_SUCCESS);
    }

    public static function warning(string $text): self
    {
        return self::make($text)->level(self::LEVEL_WARNING);
    }

    public static function error(string $text): self
    {
        return self::make($text)->level(self::LEVEL_ERROR);
    }

    public static function make(string $text): self
    {
        return new self($text);
    }

    public function __construct(string $text, string $level = self::LEVEL_MESSAGE)
    {
        $this->level($level);
        $this->text($text);
        $this->title = '';
        $this->links = [];
        $this->messages = new MessageBag();
    }

    //======================================================================
    // SETTERS
    //======================================================================

    public function level(string $level): self
    {
        if (!in_array($level, self::levels())) {
            throw new \DomainException("Invalid message level: $level");
        }

        $this->level = $level;

        return $this;
    }

    public function text(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function messages(array $messages): self
    {
        $this->messages = new MessageBag($messages);

        return $this;
    }

    public function addMessage(string $field, string ...$messages): self
    {
        if (empty($messages)) {
            $this->messages->merge([$field]);
        } else {
            foreach ($messages as $message) {
                $this->messages->add($field, $message);
            }
        }

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

    public function getText(): string
    {
        return $this->text;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMessageBag(): MessageBag
    {
        return $this->messages;
    }

    public function getLinks(): array
    {
        return $this->links;
    }

    public function toArray(): array
    {
        return [
            'level'      => $this->level,
            'title'      => $this->title,
            'message'    => $this->text,
            'messageBag' => $this->messages,
            'links'      => $this->links,
        ];
    }
}
