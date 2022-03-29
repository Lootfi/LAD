## Setup

#### Clone this project then follow these steps:

-   `composer install --ignore-platform-reqs`
-   `cp .env.example .env` then setup your new database name in `DB_DATABASE`
-   `php artisan key:generate`
-   `php artisan migrate --seed`
-   `php artisan adminlte:install` (but don't replace the config file when asked)
-   Login with either `teacher@example.com:password` or `student01@example.com:password`

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
