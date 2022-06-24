## Setup

#### Requirements

-   [PHP 8](https://www.php.net/downloads.php)
-   [Composer v2](https://getcomposer.org/download/)
-   [LTS node and npm](https://nodejs.org/en/)

#### Clone this project then follow these steps:

-   `composer install` to install PHP dependencies.
-   `npm install` to install Javascript dependencies.
-   Setup your SQL database (Preferably MySQL).
-   `cp .env.example .env` to copy `.env.example` to `.env`. then setup your new database config inside the `.env` file in: `DB_DATABASE` the name of your database, `DB_USERNAME` your MySQL server username, `DB_PASSWORD` your MySQL server password.
-   `php artisan key:generate` to generate a private encryption key for your session data and cookies.
-   `php artisan migrate --seed` this will create and fill the database tables for you. (make sure your local MySQL is running and that the database exists before running this)
-   `php artisan adminlte:install` (don't replace the config file when asked) this will setup the frontend requirements.
-   `npm run dev` to compile your frontend assets using webpack.
-   `php artisan serve` to serve the project (you can change host/port with options).
-   `php artisan websockets:serve` to serve the websockets server.
-   go to `http://localhost:8000/`
-   Login with either `teacher01@example.com:password`, `student01@example.com:password`

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Websockets

This project uses [laravel-websockets](https://beyondco.de/docs/laravel-websockets/getting-started/introduction). And listens for [Laravel Echo](https://laravel.com/docs/9.x/broadcasting#client-side-installation) Events (students' activities) inside [Livewire](https://laravel-livewire.com/docs/2.x/laravel-echo#listeners) components (teacher's dashboard).

## Logging Student's Activity

This projects logs students' activities using [laravel-activitylog](https://spatie.be/docs/laravel-activitylog/v4/introduction), most activities are logged when an event is fired, but some are logged automatically using the [Logging model events feature](https://spatie.be/docs/laravel-activitylog/v4/advanced-usage/logging-model-events).

As for student's online session. it is simply kept in cache for 30 seconds for now.

```php
$expireTime = Carbon::now()->addSeconds(30);
Cache::put('is_online_' . $user->id, true, $expireTime);
```
