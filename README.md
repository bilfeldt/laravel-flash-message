# Flash multiple advanced messages with both text, messages and links

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bilfeldt/laravel-flash-message.svg?style=flat-square)](https://packagist.org/packages/bilfeldt/laravel-flash-message)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/bilfeldt/laravel-flash-message/run-tests?label=tests)](https://github.com/bilfeldt/laravel-flash-message/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/bilfeldt/laravel-flash-message/Check%20&%20fix%20styling?label=code%20style)](https://github.com/bilfeldt/laravel-flash-message/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bilfeldt/laravel-flash-message.svg?style=flat-square)](https://packagist.org/packages/bilfeldt/laravel-flash-message)

An opinionated solution for flashing multiple advanced messages from the backend and showing these on the frontend using prebuild customizable Tailwind CSS alert blade components.

## Installation

Install the package via composer and you are ready to add messages and show these on the frontend.

```bash
composer require bilfeldt/laravel-flash-message
```

**Optional:** In case you wish to use the [message flashing](https://laravel.com/docs/master/responses#redirecting-with-flashed-session-data) feature allowing messages to be made available on the next request (usefull in combination with redirects) simply add the `ShareMessagesFromSession` middleware to the `web` group defined in `app/Http/Kernel.php` just after the `ShareErrorsFromSession` middleware:

```php
// app/Http/Kernel.php

/**
 * The application's route middleware groups.
 *
 * @var array
 */
protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Laravel\Jetstream\Http\Middleware\AuthenticateSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Bilfeldt\LaravelFlashMessage\Http\Middleware\ShareMessagesFromSession::class, // <------ ADDED HERE
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
    ...
```

## Usage

The most basic usage of this package is creating a message inside a controller and passing it to the view:

```php
<?php

namespace App\Http\Controllers;

use Bilfeldt\LaravelFlashMessage\Message;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     */
    public function index(Request $request)
    {
        $message = Message::warning('This is a simple message intended for you') // message/success/info/warning/error
            ->title('This is important')
            ->addMessage('account', 'There is 10 days left of your free trial')
            ->link('Read more', 'https://example.com/signup');
            
        return view('posts')->withMessage($message);
    }
}
```

### Redirects

Sometimes a redirect is returned to the user instead of a view. In that case the message must be flashed to the session so that they are available on the subsequent request. This is simply done by flashing the `$message`:

```php
<?php

namespace App\Http\Controllers;

use Bilfeldt\LaravelFlashMessage\Message;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     */
    public function index(Request $request)
    {
        $message = Message::warning('This is a simple message intended for you') // message/success/info/warning/error
            ->title('This is important')
            ->addMessage('account', 'There is 10 days left of your free trial')
            ->link('Read more', 'https://example.com/signup');
            
        return redirect('/posts')->withMessage($message); // This will flash the message to the Laravel session
    }
}
```

Note that for this to work you will need to add the `ShareMessagesFromSession` middleware to `app/Http/Kernel.php` as described in the [installation section](#installation) above.

In the situations where we need to flash a message to session without access to a redirect, like in a Laravel Livewire component, then we have added a small helper method `session_message($message)` which does the same.

### Adding message from anywhere in the code

Messages can be adding bacially anywhere in the codebase using the `View` facade. Although most usecases will be adding the messages from the controller, then this feature can be really powerful for example conjunction with middlewares:

```php
\Illuminate\Support\Facades\View::withMessage($message);
```

### Show messages

Once messages have been passed to the frontend these can be shown by simply using the following component in any view file:

```php
<x-flash-alert-messages />
```

## Multiple message bags

There might be situations where it can be usefull to have multiple "MessagebBags" (the same approach as Laravel usese for the validation messages) and in this case one can name the bag like so:

```php
return view('posts')->withMessage($message, 'bag-name');
// or 
return redirect('/posts')->withMessage($message, 'bag-name');
```

and when displaying the messages simply pass the bag name as well:

```php
<x-flash-alert-messages bag='bag-name' />
```

## Tip

You might have a layout where you would always like to flash the messages above the main content or just below the title. You can simply add the `<x-flash-message.alert />` to your layout file in the place you would like the messages to show and that way you do not need to call this in multiple views.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Anders Bilfeldt](https://github.com/bilfeldt)
- [iAmine](https://tailwindcomponents.com/u/iaminos) for the [Alert blade components](https://tailwindcomponents.com/component/alerts-components)
- [Showcode.app](https://showcode.app/) used for creating repository banner

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
