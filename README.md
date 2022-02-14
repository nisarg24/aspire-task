<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Installation Step

## Step 1
- Go to the repository and run command 
```
composer install
```

## Step 2
- Create database and configure it in .env file

## Step 3
- Run migration command
```
php artisan migrate
```

## Step 4
- Run seeder command to generate admin user
```
php artisan db:seed
```

## How to use mini aspire task?

## Step 1
- Run command
```
php artisan serve
```

## Step 2
- Use postman collection for the api

## Step 3
- Run command to emi auto payment
```
php artisan loan:emi-payment
```

## How to execute test cases?

## Step 1
- Copy database variable from .env.testing file to .env file
```
DB_CONNECTION=sqlite
DB_HOST=
DB_PORT=
DB_DATABASE=database/test.sqlite
DB_USERNAME=
DB_PASSWORD=
```

## Step 2
- Run database migration command and seeder command
```
php artisan migrate
```
```
php artisan db:seed
```

## Step 3
- Run command to clear config cache
```
php artisan config:clear
```

## Step 4
- Run command to execute test cases
```
.\vendor\bin\phpunit
```
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
