# PHP 7+ `security.txt` Package

[![Current Release](https://img.shields.io/github/release/austinheap/php-security-txt.svg)](https://github.com/austinheap/php-security-txt/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/austinheap/php-security-txt.svg)](https://packagist.org/packages/austinheap/php-security-txt)
[![Build Status](https://travis-ci.org/austinheap/php-security-txt.svg?branch=master)](https://travis-ci.org/austinheap/php-security-txt)
[![Maintainability](https://api.codeclimate.com/v1/badges/9bf8799e6e3a0209c318/maintainability)](https://codeclimate.com/github/austinheap/php-security-txt/maintainability)
[![Scrutinizer CI](https://scrutinizer-ci.com/g/austinheap/php-security-txt/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/austinheap/php-security-txt/)
[![SensioLabs](https://insight.sensiolabs.com/projects/1edfb22e-593b-43b1-88cd-98965541a2cc/mini.png)](https://insight.sensiolabs.com/projects/1edfb22e-593b-43b1-88cd-98965541a2cc)
[![Test Coverage](https://api.codeclimate.com/v1/badges/9bf8799e6e3a0209c318/test_coverage)](https://codeclimate.com/github/austinheap/php-security-txt/test_coverage)
[![StyleCI](https://styleci.io/repos/108443771/shield?branch=master)](https://styleci.io/repos/108443771)

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
        "austinheap/php-security-txt": "0.3.*"
    }
}
```

### Step 2: Manipulate a `security.txt` document

To programatically create a `security.txt` document, you could do:

```php
require_once 'vendor/autoload.php';

$writer = new \AustinHeap\Security\Txt\Writer;

print $writer->setContact('me@austinheap.com')
             ->setEncryption('http://some.url/pgp.key')
             ->setDisclosure('full')
             ->setAcknowledgement('http://some.url/acks')
             ->getText();
```

Which should output:

```
# Our security address
Contact: me@austinheap.com

# Our PGP key
Encryption: http://some.url/pgp.key

# Our disclosure policy
Disclosure: Full

# Our public acknowledgement
Acknowledgement: http://some.url/acks

#
# Generated by "php-security-txt" v0.3.0 (https://github.com/austinheap/php-security-txt/releases/tag/v0.3.0)
# in 0.041008 seconds on 2017-10-26 20:31:25.
#
```

## References

- [A Method for Web Security Policies (draft-foudil-securitytxt-00)](https://tools.ietf.org/html/draft-foudil-securitytxt-00)
- [laravel-security-txt](https://github.com/austinheap/laravel-security-txt)

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
