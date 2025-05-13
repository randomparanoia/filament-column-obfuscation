<?php

namespace RandomParanoia\FilamentColumnObfuscation;

use rndparanoia\FilamentColumnObfuscation\Commands\FilamentColumnObfuscationCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentColumnObfuscationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('randomparanoia-filament-column-obfuscation')
            ->hasViews();
    }
}
