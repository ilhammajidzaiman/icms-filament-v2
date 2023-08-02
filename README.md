<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Contents

1. [Laravel](#laravel)
2. [Filamentphp](#filamentphp)
    - [Instalation Filamentphp](#installation-filamentphp)
3. [Filament Access and Menu Management Plugin](#filament-access-and-menu-management-plugin)
    - [Instalation Plugin](#installation-plugin)

<br>
<br>
<br>
<br>
<br>

# Laravel

See more documentation of [here](https://laravel.com/docs/).

## Installation

Install larvel using composer:

```bash
composer create-project laravel/laravel example-app
```

[to top ☝️](#contents)
<br>
<br>
<br>
<br>
<br>

# Filamentphp

See more documentation of Filamentphp [here](https://filamentphp.com/docs/).

## Installation Filamentphp

Install filamentphp:

```bash
composer require filament/filament
#or
composer require filament/filament:"^2.0"
```

Add to **composer.json**:

```bash
"post-update-cmd": [
    // ...
    "@php artisan filament:upgrade"
],
```

[to top ☝️](#contents)
<br>
<br>
<br>
<br>
<br>

# Filament Access and Menu Management Plugin

See more documentation of Filament Access and Menu Management Plugin [here](https://github.com/solutionforest/filament-access-management).

## Installation Plugin

install the package via composer:

```bash
composer require solution-forest/filament-access-management
```

Add the necessary trait to your User model:

```bash
use SolutionForest\FilamentAccessManagement\Concerns\FilamentUser;

class User extends Authenticatable
{
    use FilamentUser;
}
```

Clear your config cache

```bash
php artisan optimize:clear
# or
php artisan config:clear
```

Execute the commands:

```bash
php artisan filament-access-management:install
```

If you don't already have a user named admin, this command creates a Super Admin User with the following credentials:

Name: admin

E-mail: admin@("slug" pattern from config("app.name")).com

Password: admin

You can also create the super admin user with:

```bash
php artisan make:super-admin-user
```

In your config/app.php place this code in you providers section:

```bash
'providers' => [
    ...
    /*
        * Package Service Providers...
        */
    \SolutionForest\FilamentAccessManagement\FilamentAuthServiceProvider::class,
    ...
],
```

### Publish Configs, Views, Translations and Migrations

You publish the configs, views, translations and migrations with:

```bash
php artisan vendor:publish --tag="filament-access-management-config"
php artisan vendor:publish --tag="filament-access-management-views"
php artisan vendor:publish --tag="filament-access-management-translations"
php artisan vendor:publish --tag="filament-access-management-migrations"
```

## Migration

```bash
php artisan migrate
```

Create super admin user:

```bash
php artisan make:super-admin-user
```

Check permission:

```bash
# Check by permission's name
\SolutionForest\FilamentAccessManagement\Http\Auth\Permission::check($name)

# Check by http_path
\SolutionForest\FilamentAccessManagement\Http\Auth\Permission::checkPermission($path)
```

Get current user:

```bash
\SolutionForest\FilamentAccessManagement\Facades\FilamentAuthenticate::user();
```

## Advance Usage

In default, the menu created will co-exist with the original menu of filament. To override the original menu with the menu from this package, modify **/config/filament-access-management.php** as following:

Set **filament.navigation.enabled => true**

```bash
'filament' => [
    ...
    'navigation' => [
        /**
         * Using db based filament navigation if true.
         */
        'enabled' => true,
        /**
         * Table name db based filament navigation.
         */
        'table_name' => 'filament_menu',
        /**
         * Filament Menu Model.
         */
        'model' => Models\Menu::class,
    ]
    ...
]
```

[to top ☝️](#contents)
<br>
<br>
<br>
<br>
<br>
