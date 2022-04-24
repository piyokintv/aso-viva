# Laravel Breeze + Inertia + Vuej 3 + Bootstreap 5

このスターターキットは、Laravel BreezeのInertia選択においてインストールされるTailwind CSSをBootstrap 5に置き換えたものです。
## 必須条件

* PHP 8.0 以降。

## インストール手順

```bash
$ git clone git@github.com:lotsofbytes/breeze-bootstrap.git
$ cd breeze-bootstrap
$ git checkout dev-japanesse-ver
$ cp .env.example .env # .envを必要に応じて編集してください。
$ composer install
$ php artisan key:gen
$ npm install
$ php artisan migrate --seed
$ php artisan serve
```
## 参照

[Laravel Breeze](https://laravel.com/docs/8.x/starter-kits#laravel-breeze)

[Inertia](https://inertiajs.com)

[Vue](https://vuejs.org)

[Bootstrap](https://getbootstrap.com)
