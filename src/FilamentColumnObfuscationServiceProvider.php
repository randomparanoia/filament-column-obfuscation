<?php

namespace rndparanoia\FilamentColumnObfuscation;

use rndparanoia\FilamentColumnObfuscation\Commands\FilamentColumnObfuscationCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentColumnObfuscationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-column-obfuscation')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament_column_obfuscation_table')
            ->hasCommand(FilamentColumnObfuscationCommand::class);
    }
}
