<?php

namespace rndparanoia\FilamentColumnObfuscation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \rndparanoia\FilamentColumnObfuscation\FilamentColumnObfuscation
 */
class FilamentColumnObfuscation extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \rndparanoia\FilamentColumnObfuscation\FilamentColumnObfuscation::class;
    }
}
