# Laravel Passport API Implementation

A laravel passport authentication api implementation

## Table of Contents

-   [Technologies](#technologies)
-   [Getting Started](#getting-started)
    -   [Installation](#installation)
    -   [Deployment](#deployment)
    -   [Usage](#usage)
## Technologies

-   [Laravel](https://laravel.com/) - PHP web framework

This project runs on Laravel 9 and requires PHP 8.0+ .

## Getting Started

### Installation

-   git clone
    [Laravel Passport API Implementation](https://github.com/mikkycody/laravel-passport-auth.git)
-   Run `composer install` to install packages .
-   Copy .env.example file, create a .env file if not created and edit database credentials there .
-   Copy .env.example file, create a .env.testing file if not created and edit database credentials there for testing, you can use in-memory db sqlite (If using in memory do not forget to create a database.sqlite file).
-   Run `php artisan key:generate` to set application key to secure user sessions and other encrypted data .
-   Run `php artisan migrate` to run database migrations.
-   Run `php artisan passport:install` to create the encryption keys needed to generate secure access tokens.
-   Run `php artisan serve` to start the server (Ignore if using valet) .
-   Run `php artisan test` to run tests .

### Deployment
-   This project has been deployed to HEROKU, please click [here](https://laravel-passport-application.herokuapp.com/api/v1) to access the deployed link.
### Usage
-   Please click [here](https://documenter.getpostman.com/view/13274153/UyrGAZ6S) to access the Postman Collection

This is the basic flow of the application.

- Register
- Login