<?php

namespace Bilfeldt\LaravelFlashMessage;

use Countable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * @mixin \Illuminate\Support\Collection
 */
class ViewFlashMessageBag implements Countable
{
    /**
     * The array of the view error bags.
     *
     * @var array
     */
    protected $bags = [];

    /**
     * Create a new instance from an associative array of message collections.
     *
     * @param array|array[] $bags
     *
     * @return ViewFlashMessageBag
     */
    public static function make(array $bags): self
    {
        $viewFlashMessageBag = new self();

        foreach ($bags as $bag => $messages) {
            $viewFlashMessageBag->put($bag, Collection::make($messages)->values()); // values() is used since we are not interested in the keys which is a uuid when using session flashing
        }

        return $viewFlashMessageBag;
    }

    /**
     * Checks if a named MessageBag exists in the bags.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasBag($key = 'default'): bool
    {
        return isset($this->bags[$key]);
    }

    /**
     * Get a MessageBag instance from the bags.
     *
     * @param string $key
     *
     * @return \Illuminate\Support\Collection|\Bilfeldt\LaravelFlashMessage\Message[]
     */
    public function getBag($key)
    {
        return Arr::get($this->bags, $key) ?: new Collection([]);
    }

    /**
     * Get all the bags.
     *
     * @return array
     */
    public function getBags()
    {
        return $this->bags;
    }

    /**
     * Add a new Message collection.
     *
     * @param string                                                                 $key
     * @param \Illuminate\Support\Collection|\Bilfeldt\LaravelFlashMessage\Message[] $messages
     *
     * @return \Bilfeldt\LaravelFlashMessage\ViewFlashMessageBag
     */
    public function put($key, \Illuminate\Support\Collection $messages): self
    {
        $this->bags[$key] = $messages;

        return $this;
    }

    /**
     * Add a new Message collection.
     *
     * @param \Bilfeldt\LaravelFlashMessage\Message $message
     * @param string                                $key
     *
     * @return \Bilfeldt\LaravelFlashMessage\ViewFlashMessageBag
     */
    public function push(Message $message, string $key = 'default'): self
    {
        $this->bags[$key] = $this->getBag($key)->push($message);

        return $this;
    }

    /**
     * Get the number of messages in the default bag.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->getBag('default')->count();
    }

    /**
     * Dynamically call methods on the default bag.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->getBag('default')->$method(...$parameters);
    }

    /**
     * Dynamically access a view message bag.
     *
     * @param string $key
     *
     * @return \Illuminate\Support\Collection|\Bilfeldt\LaravelFlashMessage\Message[]
     */
    public function __get($key)
    {
        return $this->getBag($key);
    }

    /**
     * Dynamically set a view message bag.
     *
     * @param string                                                                 $key
     * @param \Illuminate\Support\Collection|\Bilfeldt\LaravelFlashMessage\Message[] $value
     *
     * @return void
     */
    public function __set($key, $value)
    {
        $this->put($key, $value);
    }
}
