<?php

namespace RandomParanoia\FilamentColumnObfuscation\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class ObfuscatedColumn extends TextColumn
{
    protected string $view = 'randomparanoia-filament-column-obfuscation::tables.columns.obfuscated-column';

    protected string $obfuscationPattern = 'default';

    public function obfuscationPattern(string $pattern): static
    {
        $this->obfuscationPattern = $pattern;

        return $this;
    }

    public function getObfuscatedValue(?string $state): string
    {
        if ($state === null) {
            return '';
        }

        return match ($this->obfuscationPattern) {
            'name' => substr($state, 0, 1).str_repeat('*', strlen($state) - 1),
            'phone' => substr($state, 0, 3).str_repeat('*', strlen($state) - 6).substr($state, -3),
            'email' => (function (string $email) {
                $parts = explode('@', $email);
                $username = $parts[0];
                $domain = $parts[1] ?? '';

                return substr($username, 0, 2).str_repeat('*', strlen($username) - 2).'@'.$domain;
            })($state),
            'address' => substr($state, 0, 5).str_repeat('*', strlen($state) - 5),
            'locality' => substr($state, 0, 2).str_repeat('*', strlen($state) - 2),
            default => substr($state, 0, 1).str_repeat('*', strlen($state) - 1),
        };
    }
}
