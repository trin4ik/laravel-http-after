# Callback "After" for Laravel HTTP Client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/trin4ik/laravel-http-after)](https://packagist.org/packages/trin4ik/laravel-http-after)
[![Total Downloads](https://img.shields.io/packagist/dt/trin4ik/laravel-http-after)](https://packagist.org/packages/trin4ik/laravel-http-after)

"After" callback function with request, response and request time for http requests with Laravel `Http` facade.

## Installation

You can install the package via composer:

```bash
composer require trin4ik/laravel-http-after
```

### Laravel

This package makes use
of [Laravels package auto-discovery mechanism](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518)
so **there is no need to do any futher steps** - skip directly to the [usage](#usage) section below. If for some reason
you wish to opt-out of package auto discovery,
check [the Laravel Docs](https://laravel.com/docs/8.x/packages#opting-out-of-package-discovery) for more details.

### Lumen

NOTE: Lumen is **not** officially supported by this package. However, we are currently not aware of any
incompatibilities.

If you use Lumen register the service provider in `bootstrap/app.php` like so:

```php
<?php
// bootstrap/app.php

$app->register(Trin4ik\LaravelHttpAfter\LaravelHttpAfterServiceProvider::class);

// If you want to use the Facades provided by the package
$app->withFacades();
```

## Usage

```php
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Http;

Http::after(function ($request, $response, $time) {
    echo "time: " . $time . PHP_EOL;
    echo "request:" . PHP_EOL . Message::toString($request) . PHP_EOL;
    echo "response:" . PHP_EOL . Message::toString($response) . PHP_EOL;
})->get('https://example.com');
```

```
time: 0.49774980545044
request:
GET / HTTP/1.1
User-Agent: GuzzleHttp/7
Host: example.com


response:
HTTP/1.1 200 OK
Accept-Ranges: bytes
Age: 443743
Cache-Control: max-age=604800
Content-Type: text/html; charset=UTF-8
Date: Tue, 26 Apr 2022 15:16:17 GMT
Etag: "3147526947+gzip"
Expires: Tue, 03 May 2022 15:16:17 GMT
Last-Modified: Thu, 17 Oct 2019 07:18:26 GMT
Server: ECS (bsa/EB19)
Vary: Accept-Encoding
X-Cache: HIT
Content-Length: 1256

<!doctype html>...
```

## Credits

- [trin4ik](https://github.com/bilfeldt)

based on [laravel-http-client-logger](https://github.com/bilfeldt/laravel-http-client-logger)
by [Anders Bilfeldt](https://github.com/bilfeldt)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.