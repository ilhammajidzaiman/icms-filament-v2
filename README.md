# Contents

1. [Laravel](#laravel)
    - [Instalation Laravel](#installation-laravel)
2. [Filamentphp](#filamentphp)
    - [Instalation Filamentphp](#installation-filamentphp)
    - [Automatically Generating](#automatically-generating)
3. [Filament Access and Menu Management Plugin](#filament-access-and-menu-management-plugin)
    - [Instalation Plugin](#installation-plugin)
    - [Publish Configs](#publish-configs)
    - [Migration](#migration)
    - [Advance Usage](#advance-usage)

<br>
<br>
<br>
<br>
<br>

# Laravel

See more documentation of [here](https://laravel.com/docs/).

## Installation Laravel

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

Add to `composer.json`:

```bash
"post-update-cmd": [
    // ...
    "@php artisan filament:upgrade"
],
```

## Automatically Generating

Install the package via composer to use automatically generating forms and tables, package `doctrine/dbal` is required to use this functionality:

```bash
composer require doctrine/dbal --dev
```

Create resource:

```bash
php artisan make:filament-resource Customer --generate
```

Add view page for view dwtail data without modal:

```bash
php artisan make:filament-page ViewCustomer --resource=CustomerResource --type=ViewRecord
```

Create resource with soft delete:

```bash
php artisan make:filament-resource Customer --generate --soft-deletes
```

Add observer for deleting file one storage:

```bash
php artisan make:observer CustomerObserver --model=Customer
```

Add function on file `app\Observer\CustomerObserver.php` on update:

```bash
public function updated(Customer $customer): void
    {
        if ($customer->isDirty('file')) {
            Storage::disk('public')->delete($customer->getOriginal('file'));
        }
    }
```

On delete or softdelete:

```bash
public function forceDeleted(Customer $customer): void
    {
        if (!is_null($customer->file)) {
            Storage::disk('public')->delete($customer->file);
        }
    }
```

[to top ☝️](#contents)
<br>
<br>
<br>
<br>
<br>

# Filament Access and Menu Management Plugin

See more documentation of Filament Access and Menu Management Plugin [here](https://v2.filamentphp.com/plugins/access-and-menu-management).

## Installation Plugin

Install the package via composer:

```bash
composer require solution-forest/filament-access-management
```

Add the necessary trait to your `User` model:

```bash
use SolutionForest\FilamentAccessManagement\Concerns\FilamentUser;

class User extends Authenticatable
{
    use FilamentUser;
}
```

In `config/app.php` place this code in you providers section:

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

Clear config cache:

```bash
php artisan optimize:clear
```

Execute the commands:

```bash
php artisan filament-access-management:install
```

### Publish Configs

Publish the configs, views, translations and migrations with:

```bash
php artisan vendor:publish --tag="filament-access-management-config"
php artisan vendor:publish --tag="filament-access-management-views"
php artisan vendor:publish --tag="filament-access-management-translations"
php artisan vendor:publish --tag="filament-access-management-migrations"
```

## Migration

Run Migration:

```bash
php artisan migrate
```

If don't already have a user named admin, this command creates a Super Admin User with the following credentials:

`Name: admin`

`E-mail: admin@("slug" pattern from config("app.name")).com`

`Password: admin`

You can also create the super admin user:

```bash
php artisan make:super-admin-user
```

## Advance Usage

In default, the menu created will co-exist with the original menu of filament. To override the original menu with the menu from this package, modify `/config/filament-access-management.php` as following: Set `filament.navigation.enabled => true`

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
