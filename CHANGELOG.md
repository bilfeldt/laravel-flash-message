# Changelog

All notable changes to `laravel-flash-message` will be documented in this file.

## 1.4.0 - 2025-02-17

- Add Laravel 12 support

## 1.3.0 - 2024-01-27

- Add PHP 8.4 support
- Drop Laravel 8 support

## 1.2.0 - 2024-02-28

- Add Laravel 11 support
- Add PHP 8.3 support

## 1.1.0 - 2023-05-01

- Add Laravel 10 support

## 1.0.0 - 2022-12-18

- initial release

### Breaking changes

Blade component are now namespaced instead of prefixed. This means that usage of the components should be changed from the old prefix syntax

```blade
<x-flash-alert ... /> // no longer supported
```

to the new namespace syntax

```blade
<x-flash::alert ... /> // new syntax
```

The session and view keys are also removed from the configuration, leaving the configuration with using the hardcoded value `messages` for both.
