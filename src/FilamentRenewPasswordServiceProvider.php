<?php

namespace MeiLABS\Filament\RenewPassword;

use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use MeiLABS\Filament\RenewPassword\Events\PasswordRenew;
use MeiLABS\Filament\RenewPassword\Pages\Auth\RenewPassword;

class FilamentRenewPasswordServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-renew-password')
            ->hasConfigFile()
            ->hasMigration('add_renew_password_on_users_table')
            ->hasRoute('web')
            ->hasTranslations()
            ->hasViews()
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('mei-labs/filament-renew-password');
            });
    }

    public function packageBooted()
    {
        Event::listen([
            PasswordRenew::class,
        ]);

        Livewire::component('mei-labs.filament.renew-password.pages.auth.renew-password', RenewPassword::class);

        parent::packageBooted();
    }
}