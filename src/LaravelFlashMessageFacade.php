<?php

namespace Bilfeldt\LaravelFlashMessage;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bilfeldt\LaravelFlashMessage\LaravelFlashMessage
 */
class LaravelFlashMessageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-flash-message';
    }
}
