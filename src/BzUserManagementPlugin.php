<?php

namespace JornBoerema\BzUserManagement;

use Filament\Contracts\Plugin;
use JornBoerema\BzUserManagement\Filament\Resources\UserResource;

class BzUserManagementPlugin implements Plugin
{

    public function getId(): string
    {
        return 'bz-user-management';
    }

    public function register(\Filament\Panel $panel): void
    {
        $panel->resources([
            UserResource::class
        ]);
    }

    public function boot(\Filament\Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return new static;
    }
}
