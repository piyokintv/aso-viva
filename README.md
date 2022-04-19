# Laravel Breeze + Inertia + Vuej 3 + Bootstreap 5

This boiler plate is based on the Laravel Breeze starter kit but this replaces Tailwind CSS with Bootstrap 5.

## Requirements

* PHP 8.0 or latest

## How to start

```bash
$ git clone git@github.com:lotsofbytes/breeze-bootstrap.git
$ cd breeze-bootstrap
$ cp .env.example .env # edit .env for your local environment
$ composer install
$ php artisan key:gen
$ npm install
$ php artisan migrate --seed
$ php artisan serve
```
## Run the project in the sub directory

Please use the branch, dev-support-subdir.

[inertiajs/inertia-laravel](https://github.com/inertiajs/inertia-laravel) (v0.5.4) has an sub directory installation [issue](https://github.com/inertiajs/inertia-laravel/issues/359). The branch has a fix by kimhf.
