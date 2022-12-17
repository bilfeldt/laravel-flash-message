# Changelog

All notable changes to `laravel-flash-message` will be documented in this file.

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
