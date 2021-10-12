<?php

namespace Bilfeldt\LaravelFlashMessage;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Bilfeldt\LaravelFlashMessage\Commands\LaravelFlashMessageCommand;

class LaravelFlashMessageServiceProvider extends PackageServiceProvider
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
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-flash-message_table')
            ->hasCommand(LaravelFlashMessageCommand::class);
    }
}
