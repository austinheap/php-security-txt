# PHP 7+ `security.txt` Package

[![Current Release](https://img.shields.io/github/release/austinheap/php-security-txt.svg)](https://github.com/austinheap/php-security-txt/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/austinheap/php-security-txt.svg)](https://packagist.org/packages/austinheap/php-security-txt)
[![Build Status](https://travis-ci.org/austinheap/php-security-txt.svg?branch=master)](https://travis-ci.org/austinheap/php-security-txt)
[![Code Climate](https://codeclimate.com/github/austinheap/php-security-txt/badges/gpa.svg)](https://codeclimate.com/github/austinheap/php-security-txt)
[![Scrutinizer CI](https://scrutinizer-ci.com/g/austinheap/php-security-txt/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/austinheap/php-security-txt/)
[![SensioLabs](https://insight.sensiolabs.com/projects/9fe66b91-58ad-4bc3-9ec9-37b396bb4837/mini.png)](https://insight.sensiolabs.com/projects/9fe66b91-58ad-4bc3-9ec9-37b396bb4837)
[![Test Coverage](https://codeclimate.com/github/austinheap/php-security-txt/badges/coverage.svg)](https://codeclimate.com/github/austinheap/php-security-txt)

## A package for manipulating `security.txt` documents in PHP 7+, based on configuration settings.

The purpose of this project is to create a set-it-and-forget-it package that can
manipulate documents following the current [`security.txt`](https://securitytxt.org/)
spec. It is therefore highly opinionated but built for configuration.

[`security.txt`](https://github.com/securitytxt) is a [draft](https://tools.ietf.org/html/draft-foudil-securitytxt-00)
"standard" which allows websites to define security policies. This "standard"
sets clear guidelines for security researchers on how to report security issues,
and allows bug bounty programs to define a scope. Security.txt is the equivalent
of `robots.txt`, but for security issues.

There is [documentation for `php-security-txt` online](https://austinheap.github.io/php-security-txt/),
the source of which is in the [`docs/`](https://github.com/austinheap/php-security-txt/tree/master/docs)
directory. The most logical place to start are the [docs for the `SecurityTxt` class](https://austinheap.github.io/php-security-txt/classes/AustinHeap.Security.Txt.SecurityTxt.html).

## Installation

### Step 1: Composer

Via Composer command line:

```bash
$ composer require austinheap/php-security-txt
```

Or add the package to your `composer.json`:

```json
{
    "require": {
        "austinheap/php-security-txt": "^0.3.0"
    }
}
```

### Step 2: Manipulate a `security.txt` document

```php
require_once 'vendor/autoload.php';

$securityTxt = new \AustinHeap\Security\Txt\SecurityTxt('path/to/security.txt');

var_dump($securityTxt->properties);
```

## References

- [A Method for Web Security Policies (draft-foudil-securitytxt-00)](https://tools.ietf.org/html/draft-foudil-securitytxt-00)

## Credits

This is a fork of [austinheap/laravel-security-txt](https://github.com/austinheap/laravel-security-txt),
which was a fork of [InfusionWeb/laravel-robots-route](https://github.com/InfusionWeb/laravel-robots-route),
which was a fork of [ellisthedev/laravel-5-robots](https://github.com/ellisthedev/laravel-5-robots),
which was a fork of [jayhealey/Robots](https://github.com/jayhealey/Robots),
which was based on earlier work.

- [ellisio/laravel-5-robots Contributors](https://github.com/ellisio/laravel-5-robots/graphs/contributors)
- [InfusionWeb/laravel-robots-route Contributors](https://github.com/InfusionWeb/laravel-robots-route/contributors)
- [austinheap/laravel-security-txt Contributors](https://github.com/austinheap/laravel-security-txt/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
