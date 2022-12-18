<?php

namespace Bilfeldt\LaravelFlashMessage;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Factory;
use Illuminate\View\View;

class FlashMessageServiceProvider extends ServiceProvider
{
    public const VIEW_COMPONENT_NAMESPACE = 'flash';

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', self::VIEW_COMPONENT_NAMESPACE);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/'.self::VIEW_COMPONENT_NAMESPACE),
        ]);

        Blade::componentNamespace('Bilfeldt\\LaravelFlashMessage\\View\\Components', self::VIEW_COMPONENT_NAMESPACE);

        // This is used when adding a message from a controller: view('posts-index')->withMessage(...)
        View::macro('withMessage', function (Message $message, string $bag = 'default'): View {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewFlashMessageBag = \Illuminate\Support\Facades\View::shared('messages', new ViewFlashMessageBag());

            \Illuminate\Support\Facades\View::share('messages', $viewFlashMessageBag->push($message, $bag));

            return $this;
        });

        // This is used when adding a message from the View Facade: \Illuminate\Support\Facades\View::withMessage(...)
        Factory::macro('withMessage', function (Message $message, string $bag = 'default'): Factory {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewFlashMessageBag = \Illuminate\Support\Facades\View::shared('messages', new ViewFlashMessageBag());

            \Illuminate\Support\Facades\View::share('messages', $viewFlashMessageBag->push($message, $bag));

            return $this;
        });

        // This is used when adding messages from a controller: view('posts-index')->withMessages(...)
        View::macro('withMessages', function (array $messages, string $bag = 'default'): View {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewFlashMessageBag = \Illuminate\Support\Facades\View::shared('messages', new ViewFlashMessageBag());

            /** @var \Bilfeldt\LaravelFlashMessage\Message $message */
            foreach ($messages as $message) {
                $viewFlashMessageBag->push($message, $bag);
            }
            \Illuminate\Support\Facades\View::share('messages', $viewFlashMessageBag);

            return $this;
        });

        // This is used when adding messages from the View Facade: \Illuminate\Support\Facades\View::withMessages(...)
        Factory::macro('withMessages', function (array $messages, string $bag = 'default'): Factory {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewFlashMessageBag = \Illuminate\Support\Facades\View::shared('messages', new ViewFlashMessageBag());

            /** @var \Bilfeldt\LaravelFlashMessage\Message $message */
            foreach ($messages as $message) {
                $viewFlashMessageBag->push($message, $bag);
            }
            \Illuminate\Support\Facades\View::share('messages', $viewFlashMessageBag);

            return $this;
        });

        /**
         * Flash a container of errors to the global errors bag.
         *
         * Note that the view already has a method 'withErrors' but that does not share them globally like this method.
         *
         * @param \Illuminate\Contracts\Support\MessageProvider|array|string $provider
         * @param string                                                     $key
         *
         * @return $this
         *
         * @see https://github.com/laravel/framework/pull/39459
         */
        View::macro('addErrors', function ($provider, $key = 'default'): View {
            /** @var ViewErrorBag $viewErrorBag */
            $viewErrorBag = \Illuminate\Support\Facades\View::shared('errors', new ViewErrorBag());

            if ($viewErrorBag->hasBag($key)) {
                $viewErrorBag->getBag($key)->merge($provider);
            } else {
                $viewErrorBag->put($key, $this->formatErrors($provider));
            }

            \Illuminate\Support\Facades\View::share('errors', $viewErrorBag);

            return $this;
        });

        // This is used to add a message from a controller when returning a redirect: redirect()->withMessage($message)
        RedirectResponse::macro('withMessage', function (Message $message, string $bag = 'default'): RedirectResponse {
            session_message($message, $bag);

            return $this;
        });

        // This is used to add messages from a controller when returning a redirect: redirect()->withMessage([$message1, $message2])
        RedirectResponse::macro('withMessages', function (array $messages, string $bag = 'default'): RedirectResponse {
            /** @var \Bilfeldt\LaravelFlashMessage\Message $message */
            foreach ($messages as $message) {
                session_message($message, $bag);
            }

            return $this;
        });
    }
}
