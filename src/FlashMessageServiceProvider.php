<?php

namespace Bilfeldt\LaravelFlashMessage;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FlashMessageServiceProvider extends PackageServiceProvider
{
    public const VIEW_COMPONENT_NAMESPACE = 'flash';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-flash-message')
            ->hasConfigFile()
            ->hasViews(); // required for the view component blade files to be registered
            // The package does not allow for namespaces (`<x-namespace:component />`) but only prefixes (`<x-prefix-component />`
            // so we register those manually using `componentNamespace()`
            //->hasViewComponents(
            //    self::VIEW_COMPONENT_NAMESPACE,
            //    Messages::class,
            //    Alert::class,
            //    AlertError::class,
            //    AlertInfo::class,
            //    AlertMessage::class,
            //    AlertSuccess::class,
            //    AlertWarning::class
            //);
    }

    public function packageBooted()
    {
        Blade::componentNamespace('Bilfeldt\\LaravelFlashMessage\\View\\Components', self::VIEW_COMPONENT_NAMESPACE);

        // This is used when adding a message from a controller: view('posts-index')->withMessage(...)
        View::macro('withMessage', function (Message $message, string $bag = 'default'): View {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewFlashMessageBag = \Illuminate\Support\Facades\View::shared(config('flash-message.view_share'), new ViewFlashMessageBag());

            \Illuminate\Support\Facades\View::share(config('flash-message.view_share'), $viewFlashMessageBag->push($message, $bag));

            return $this;
        });

        // This is used when adding a message from the View Facade: \Illuminate\Support\Facades\View::withMessage(...)
        Factory::macro('withMessage', function (Message $message, string $bag = 'default'): Factory {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewFlashMessageBag = \Illuminate\Support\Facades\View::shared(config('flash-message.view_share'), new ViewFlashMessageBag());

            \Illuminate\Support\Facades\View::share(config('flash-message.view_share'), $viewFlashMessageBag->push($message, $bag));

            return $this;
        });

        // This is used when adding messages from a controller: view('posts-index')->withMessages(...)
        View::macro('withMessages', function (array $messages, string $bag = 'default'): View {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewFlashMessageBag = \Illuminate\Support\Facades\View::shared(config('flash-message.view_share'), new ViewFlashMessageBag());

            /** @var \Bilfeldt\LaravelFlashMessage\Message $message */
            foreach ($messages as $message) {
                $viewFlashMessageBag->push($message, $bag);
            }
            \Illuminate\Support\Facades\View::share(config('flash-message.view_share'), $viewFlashMessageBag);

            return $this;
        });

        // This is used when adding messages from the View Facade: \Illuminate\Support\Facades\View::withMessages(...)
        Factory::macro('withMessages', function (array $messages, string $bag = 'default'): Factory {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewFlashMessageBag = \Illuminate\Support\Facades\View::shared(config('flash-message.view_share'), new ViewFlashMessageBag());

            /** @var \Bilfeldt\LaravelFlashMessage\Message $message */
            foreach ($messages as $message) {
                $viewFlashMessageBag->push($message, $bag);
            }
            \Illuminate\Support\Facades\View::share(config('flash-message.view_share'), $viewFlashMessageBag);

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
        View::macro('withGlobalErrors', function ($provider, $key = 'default'): View {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewErrorBag = \Illuminate\Support\Facades\View::shared('errors', new ViewErrorBag());

            if ($viewErrorBag->hasBag($key)) {
                $viewErrorBag->getBag($key)->merge($provider);
            } else {
                $viewErrorBag->put($key, $this->formatErrors($provider));
            }

            \Illuminate\Support\Facades\View::share('errors', $viewFlashMessageBag);

            return $this;
        });

        // This will ensure that the $message variable is always available even if the ShareMessagesFromSession middleware is not applied.
        //\Illuminate\Support\Facades\View::share(
        //    config('flash-message.view_share'),
        //    \Illuminate\Support\Facades\View::shared(config('flash-message.view_share'), new ViewFlashMessageBag())
        //);
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
