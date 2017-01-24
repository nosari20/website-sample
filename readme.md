# Laravel + Bootstrap Sass + Font Awesome Sass + Material Design Lite(admin) Boilerplate

## Features
  - Bootstrap Sass Installed
  - Font Awesome Sass Installed
  - Material design admin (responsive)
  - Login/Register admin (can't register more than one admin)
  - Reset password with email
  - One page template


## Requirements
  - Composer installed globally or composer.phar
  - Sass installed globally
  - Compass installed globally


## Installation

### 1. Create .env file and config admin default
```
APP_ENV=local
APP_KEY=SomeRandomString
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=mail


SUPER_ADMIN_EMAIL=admin@admin.com
```


### 2. Install vendor and run migrations
```sh
$ composer install
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
```

## Compass

### Front Office
```sh
$ cd my-app/public/assets
$ compass watch
```

### Back Office
```sh
$ cd my-app/public/admin-assets
$ compass watch
```


## Official Documentation
  - [Laravel](http://laravel.com/docs)
  - [Material Design Lite](https://getmdl.io/)
  - [Bootstrap](http://getbootstrap.com/)
  - [Fontawesome](http://fontawesome.io/icons/)
  - [Sass](http://sass-lang.com/documentation/file.SASS_REFERENCE.html)
  - [Compass](http://compass-style.org/help/)
