<?php

namespace Bilfeldt\LaravelFlashMessage;

use Bilfeldt\LaravelFlashMessage\View\Components\Alert;
use Bilfeldt\LaravelFlashMessage\View\Components\AlertMessages;
use Bilfeldt\LaravelFlashMessage\View\Components\Error;
use Bilfeldt\LaravelFlashMessage\View\Components\Info;
use Bilfeldt\LaravelFlashMessage\View\Components\Message;
use Bilfeldt\LaravelFlashMessage\View\Components\Success;
use Bilfeldt\LaravelFlashMessage\View\Components\Test;
use Bilfeldt\LaravelFlashMessage\View\Components\Warning;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FlashMessageServiceProvider extends PackageServiceProvider
{
    const VIEW_COMPONENT_NAMESPACE = 'flash';

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
        //\Blade::component('test', Test::class, 'flash');
        //\Blade::componentNamespace('Bilfeldt\LaravelFlashMessage\\Views\\Components', 'flash');

        //$this->loadViewComponentsAs('flash', [
        //    Error::class,
        //]);

        /*
        $this->loadViewComponentsAs('flash', [
            Error::class,
        ]);
        */

        View::macro('withMessage', function (\Bilfeldt\LaravelFlashMessage\Message $message): View {
            /** @var Collection $message */
            $messages = \Illuminate\Support\Facades\View::shared(config('flash-message.view_share'), Collection::make([]));

            \Illuminate\Support\Facades\View::share(config('flash-message.view_share'), $messages->push($message));

            return $this;
        });
    }
}
