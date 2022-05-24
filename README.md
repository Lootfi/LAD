## Setup

#### Clone this project then follow these steps:

-   `composer install`
-   `cp .env.example .env` then setup your new database config `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
-   `php artisan key:generate`
-   `php artisan migrate:fresh --seed` (make sure your local mysql is running and that the database exists before running this)
-   `php artisan adminlte:install` (but don't replace the config file when asked)
-   `npm run dev`
-   Serve the project the way you prefer
-   Serve websockets `php artisan websockets:serve`
-   Login with either `teacher@example.com:password`, `student01@example.com:password` or `student02@example.com:password`

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