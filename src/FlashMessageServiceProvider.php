<?php

namespace Bilfeldt\LaravelFlashMessage;

use Bilfeldt\LaravelFlashMessage\View\Components\Alert;
use Bilfeldt\LaravelFlashMessage\View\Components\AlertError;
use Bilfeldt\LaravelFlashMessage\View\Components\AlertInfo;
use Bilfeldt\LaravelFlashMessage\View\Components\AlertMessage;
use Bilfeldt\LaravelFlashMessage\View\Components\AlertSuccess;
use Bilfeldt\LaravelFlashMessage\View\Components\AlertWarning;
use Bilfeldt\LaravelFlashMessage\View\Components\Messages;
use Illuminate\Http\RedirectResponse;
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
            ->hasViews() // required for the view component blade files to be registered
            ->hasViewComponents(
                self::VIEW_COMPONENT_NAMESPACE,
                Messages::class,
                Alert::class,
                AlertError::class,
                AlertInfo::class,
                AlertMessage::class,
                AlertSuccess::class,
                AlertWarning::class
            );
    }

    public function packageBooted()
    {
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
