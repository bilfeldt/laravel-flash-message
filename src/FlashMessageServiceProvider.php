<?php

namespace Bilfeldt\LaravelFlashMessage;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FlashMessageServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-flash-message')
            ->hasConfigFile();
    }

    public function packageBooted()
    {
        View::macro('withMessage', function (\Bilfeldt\LaravelFlashMessage\Message $message): View {
            /** @var Collection $message */
            $messages = \Illuminate\Support\Facades\View::shared(config('flash-message.view_share'), Collection::make([]));

            \Illuminate\Support\Facades\View::share(config('flash-message.view_share'), $messages->push($message));

            return $this;
        });
    }
}
