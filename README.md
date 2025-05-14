# Filament Column Obfuscation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/randomparanoia/filament-column-obfuscation.svg?style=flat-square)](https://packagist.org/packages/randomparanoia/filament-column-obfuscation)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/randomparanoia/filament-column-obfuscation/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/randomparanoia/filament-column-obfuscation/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/randomparanoia/filament-column-obfuscation/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/randomparanoia/filament-column-obfuscation/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/randomparanoia/filament-column-obfuscation.svg?style=flat-square)](https://packagist.org/packages/randomparanoia/filament-column-obfuscation)

A Filament plugin that allows you to easily obfuscate sensitive data in table columns, protecting personally identifiable information (PII) and other confidential data in your Filament admin panels.

## Features

-   Mask sensitive data in Filament table columns (emails, phone numbers, addresses, etc.)
-   Customizable obfuscation patterns (show first/last X characters, use custom characters)
-   Toggle visibility with click/hover actions
-   Simple integration with existing Filament tables

## Planned Features

-   Role-based permissions for viewing unobfuscated data

## Example

```php
use RandomParanoia\FilamentColumnObfuscation\Columns\ObfuscatedColumn;

// In your Filament resource or table
public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Basic usage - masks most characters
            ObfuscatedColumn::make('email')
                ->label('Email Address'),

            // Advanced usage with customization
            ObfuscatedColumn::make('phone_number')
                ->obfucastionPattern('phone')
                ->label('Phone Number')
                ->showFirstChars(3)
                ->showLastChars(2)
                ->obfuscationCharacter('*')
                ->revealOnClick(),
        ]);
}
```

## Installation

You can install the package via composer:

```bash
composer require randomparanoia/filament-column-obfuscation
```

Optionally, you can publish the views using:

```bash
php artisan vendor:publish --tag="filament-column-obfuscation-views"
```

## Usage

### Basic Usage

```php
use RandomParanoia\FilamentColumnObfuscation\Columns\ObfuscatedColumn;

ObfuscatedColumn::make('email')
    ->label('Email Address');
```

### Preset Obfuscation Patterns

```php
use RandomParanoia\FilamentColumnObfuscation\Columns\ObfuscatedColumn;

ObfuscatedColumn::make('email')
    ->obfuscationPattern('email')
    ->label('Email Address');
```

-   `default` (default): Obfuscate all characters
-   `name`: Show first letter and last letter of the name
-   `phone`: Show first 3 digits, last 3 digits, and all digits in between
-   `email`: Show first 2 letters, last 2 letters, and all letters in between
-   `address`: Show first 5 letters and last 5 letters
-   `locality`: Show first 2 letters and last 2 letters

### Customizing Obfuscation

```php
ObfuscatedColumn::make('credit_card')
    ->showFirstChars(4)             // Show first 4 characters
    ->showLastChars(4)              // Show last 4 characters
    ->obfuscationCharacter('-')     // Use custom character
    ->revealOnClick()               // Allow revealing on click
    ->revealOnHover()               // OR allow revealing on hover
```

### Available Methods

-   `showFirstChars(int $count)`: Show the first X characters
-   `showLastChars(int $count)`: Show the last X characters
-   `obfuscationCharacter(string $char)`: Set the obfuscation character
-   `revealOnClick(bool $revealable = true)`: Enable click-to-reveal functionality
-   `revealOnHover(bool $revealable = true)`: Enable hover-to-reveal functionality

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Luís Canadas](https://github.com/randomparanoia)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
