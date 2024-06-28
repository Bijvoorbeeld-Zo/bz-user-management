## Prerequisites
For this plugin to work, you'll need to have the [Filament Shield](https://filamentphp.com/plugins/bezhansalleh-shield) plugin installed and configured.

## Installation

Your can install the package via composer:

```bash
composer require jornboerema/bz-user-management
```

Install the plugin with:

```bash
php artisan bz-user-management:install
```

## Usage

Register the plugin in your AdminPanelProvider.

```php
use Filament\Panel;
use JornBoerema\BzUserManagement\BzUserManagementPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            BzUserManagementPlugin::make(),
        ]);
}
```

## Publish assets
