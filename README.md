# Laravel List Middleware
Laravel 11 `php artisan route:list` does not provide middleware details anymore. This command will generate a breakdown similar to route:list but for your routes middleware.


## Install
```composer
composer require levizoesch/laravel-list-middleware
```

## Use
```artisan
php artisan route:list-middleware
```


## Example
```

+----------+----------------------------------+--------------------------+-----------------------------------------------------------------+------+-------------------------------------------------------------------------+
| Method   | URI                              | Name                     | Middleware                                                      | Type | Controller@Method                                                       |
+----------+----------------------------------+--------------------------+-----------------------------------------------------------------+------+-------------------------------------------------------------------------+
| GET|HEAD | _debugbar/open                   | debugbar.openhandler     | Barryvdh\Debugbar\Middleware\DebugbarEnabled                    | WEB  | Barryvdh\Debugbar\Controllers\OpenHandlerController@handle              |
| GET|HEAD | _debugbar/clockwork/{id}         | debugbar.clockwork       | Barryvdh\Debugbar\Middleware\DebugbarEnabled                    | WEB  | Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork           |
| GET|HEAD | _debugbar/assets/stylesheets     | debugbar.assets.css      | Barryvdh\Debugbar\Middleware\DebugbarEnabled                    | WEB  | Barryvdh\Debugbar\Controllers\AssetController@css                       |
| GET|HEAD | _debugbar/assets/javascript      | debugbar.assets.js       | Barryvdh\Debugbar\Middleware\DebugbarEnabled                    | WEB  | Barryvdh\Debugbar\Controllers\AssetController@js                        |
| DELETE   | _debugbar/cache/{key}/{tags?}    | debugbar.cache.delete    | Barryvdh\Debugbar\Middleware\DebugbarEnabled                    | WEB  | Barryvdh\Debugbar\Controllers\CacheController@delete                    |
| GET|HEAD | login                            | login                    | web, guest                                                      | WEB  | App\Http\Controllers\Auth\AuthenticatedSessionController@create         |
| POST     | login                            | N/A                      | web, guest                                                      | WEB  | App\Http\Controllers\Auth\AuthenticatedSessionController@store          |
| GET|HEAD | forgot-password                  | password.request         | web, guest                                                      | WEB  | App\Http\Controllers\Auth\PasswordResetLinkController@create            |
| POST     | forgot-password                  | password.email           | web, guest                                                      | WEB  | App\Http\Controllers\Auth\PasswordResetLinkController@store             |
| GET|HEAD | reset-password/{token}           | password.reset           | web, guest                                                      | WEB  | App\Http\Controllers\Auth\NewPasswordController@create                  |
| POST     | reset-password                   | password.store           | web, guest                                                      | WEB  | App\Http\Controllers\Auth\NewPasswordController@store                   |
| GET|HEAD | verify-email                     | verification.notice      | web, auth                                                       | WEB  | App\Http\Controllers\Auth\EmailVerificationPromptController             |
| GET|HEAD | verify-email/{id}/{hash}         | verification.verify      | web, auth, signed, throttle:6,1                                 | WEB  | App\Http\Controllers\Auth\VerifyEmailController                         |
| POST     | email/verification-notification  | verification.send        | web, auth, throttle:6,1                                         | WEB  | App\Http\Controllers\Auth\EmailVerificationNotificationController@store |
| GET|HEAD | confirm-password                 | password.confirm         | web, auth                                                       | WEB  | App\Http\Controllers\Auth\ConfirmablePasswordController@show            |
| POST     | confirm-password                 | N/A                      | web, auth                                                       | WEB  | App\Http\Controllers\Auth\ConfirmablePasswordController@store           |
| PUT      | password                         | password.update          | web, auth                                                       | WEB  | App\Http\Controllers\Auth\PasswordController@update                     |
| POST     | logout                           | logout                   | web, auth                                                       | WEB  | App\Http\Controllers\Auth\AuthenticatedSessionController@destroy        |
+----------+----------------------------------+--------------------------+-----------------------------------------------------------------+------+-------------------------------------------------------------------------+
```