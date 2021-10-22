# Flash multiple messages using Laravels default session message flashing system

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bilfeldt/laravel-flash-message.svg?style=flat-square)](https://packagist.org/packages/bilfeldt/laravel-flash-message)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/bilfeldt/laravel-flash-message/run-tests?label=tests)](https://github.com/bilfeldt/laravel-flash-message/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/bilfeldt/laravel-flash-message/Check%20&%20fix%20styling?label=code%20style)](https://github.com/bilfeldt/laravel-flash-message/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bilfeldt/laravel-flash-message.svg?style=flat-square)](https://packagist.org/packages/bilfeldt/laravel-flash-message)

An opinionated zero configuration solution for flashing multiple messages with title, text, bullets and links from the backend and showing this on the frontend using Laravel existing session flashing options.

## Installation

Simply install the package via composer and you are ready to flash messages:

```bash
composer require bilfeldt/laravel-flash-message
```

## Usage

Messages can be flashed from anywhere in the codebase but often in a controller like so:

```php
// Generic message
LaravelFlashMessageFacade::message('This is a simple message intended for you')
  ->title('Important message')
  ->bullets('Bullet text 1', 'Bullet text 2')
  ->link('read more', 'https://example.com')
  ->flash();

// Error message
LaravelFlashMessageFacade::error('This is a sad message intended for you') // Possible types: info/success/warning/error
  ->title('Bad news')
  ->bullets('Something went wrong', 'But so did this')
  ->links(['read more' => 'https://example.com'])
  ->flash();
```

The messages are then shown in a frontend view file like so:

```php
<x-flash-message::alert />
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

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
