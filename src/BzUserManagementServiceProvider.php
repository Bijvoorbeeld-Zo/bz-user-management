<?php

namespace JornBoerema\BzUserManagement;

use JornBoerema\BzUserManagement\Livewire\AcceptInvitation;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use \Spatie\LaravelPackageTools\PackageServiceProvider;

class BzUserManagementServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
            ->name('bz-user-management')
            ->hasViews()
            ->hasConfigFile('bz-user-management')
            ->hasMigrations('create_invitations_table')
            ->hasTranslations()
            ->hasRoute('web')
            ->hasInstallCommand(function (InstallCommand $installCommand) {
                $installCommand->publishMigrations();
                $installCommand->publishConfigFile();
            });
    }

    public function boot()
    {
        parent::boot();

        Livewire::component('jorn-boerema.bz-user-management.livewire.accept-invitation', AcceptInvitation::class);
    }
}
