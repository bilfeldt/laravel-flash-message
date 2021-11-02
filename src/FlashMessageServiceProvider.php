<?php

namespace Bilfeldt\LaravelFlashMessage;

use Bilfeldt\LaravelFlashMessage\Message;
use Bilfeldt\LaravelFlashMessage\View\Components\Alert;
use Bilfeldt\LaravelFlashMessage\View\Components\AlertMessages;
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
                Alert::class,
                AlertMessages::class
            );
    }

    public function packageBooted()
    {
        View::macro('withMessage', function (Message $message, string $bag = 'default'): View {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewFlashMessageBag = \Illuminate\Support\Facades\View::shared(config('flash-message.view_share'), new ViewFlashMessageBag());

            \Illuminate\Support\Facades\View::share(config('flash-message.view_share'), $viewFlashMessageBag->push($message, $bag));

            return $this;
        });

        Factory::macro('withMessage', function (Message $message, string $bag = 'default'): Factory {
            /** @var ViewFlashMessageBag $viewFlashMessageBag */
            $viewFlashMessageBag = \Illuminate\Support\Facades\View::shared(config('flash-message.view_share'), new ViewFlashMessageBag());

            \Illuminate\Support\Facades\View::share(config('flash-message.view_share'), $viewFlashMessageBag->push($message, $bag));

            return $this;
        });

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
    }
}
