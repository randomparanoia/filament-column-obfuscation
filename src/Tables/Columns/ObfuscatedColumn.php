<?php

namespace RandomParanoia\FilamentColumnObfuscation\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class ObfuscatedColumn extends TextColumn
{
    /**
     * @var view-string
     */
    protected string $view = 'randomparanoia-filament-column-obfuscation::tables.columns.obfuscated-column';

    protected string $obfuscationPattern = 'default';

    protected int $showFirstChars = 0;

    protected int $showLastChars = 0;

    protected string $obfuscationCharacter = '*';

    protected bool $revealOnClick = true;

    protected bool $revealOnHover = false;

    public function obfuscationPattern(string $pattern): static
    {
        $this->obfuscationPattern = $pattern;

        return $this;
    }

    public function showFirstChars(int $count): static
    {
        $this->showFirstChars = $count;

        return $this;
    }

    public function showLastChars(int $count): static
    {
        $this->showLastChars = $count;

        return $this;
    }

    public function obfuscationCharacter(string $character): static
    {
        $this->obfuscationCharacter = $character;

        return $this;
    }

    public function revealOnClick(bool $condition = true): static
    {
        $this->revealOnClick = $condition;
        $this->revealOnHover = $condition ? false : $this->revealOnHover;

        return $this;
    }

    public function revealOnHover(bool $condition = true): static
    {
        $this->revealOnHover = $condition;
        $this->revealOnClick = $condition ? false : $this->revealOnClick;

        return $this;
    }

    public function getObfuscatedValue(?string $state): string
    {
        if ($state === null || $state === '') {
            return '';
        }

        // If using custom first/last chars settings
        if ($this->showFirstChars > 0 || $this->showLastChars > 0) {
            $length = mb_strlen($state);
            $firstChars = $this->showFirstChars > 0 ? mb_substr($state, 0, $this->showFirstChars) : '';
            $lastChars = $this->showLastChars > 0 ? mb_substr($state, -$this->showLastChars) : '';

            $middleLength = $length - $this->showFirstChars - $this->showLastChars;
            $middleChars = $middleLength > 0 ? str_repeat($this->obfuscationCharacter, $middleLength) : '';

            return $firstChars . $middleChars . $lastChars;
        }

        // Using predefined patterns
        return match ($this->obfuscationPattern) {
            'name' => mb_substr($state, 0, 1) . str_repeat($this->obfuscationCharacter, mb_strlen($state) - 1),
            'phone' => mb_substr($state, 0, 3) . str_repeat($this->obfuscationCharacter, mb_strlen($state) - 6) . mb_substr($state, -3),
            'email' => (function (string $email) {
                $parts = explode('@', $email);
                $username = $parts[0];
                $domain = $parts[1] ?? '';

                return mb_substr($username, 0, 2) . str_repeat($this->obfuscationCharacter, mb_strlen($username) - 2) . '@' . $domain;
            })($state),
            'address' => mb_substr($state, 0, 5) . str_repeat($this->obfuscationCharacter, mb_strlen($state) - 5),
            'locality' => mb_substr($state, 0, 2) . str_repeat($this->obfuscationCharacter, mb_strlen($state) - 2),
            default => str_repeat($this->obfuscationCharacter, mb_strlen($state)),
        };
    }

    public function getRevealOnClick(): bool
    {
        return $this->revealOnClick;
    }

    public function getRevealOnHover(): bool
    {
        return $this->revealOnHover;
    }

    public function getObfuscationCharacter(): string
    {
        return $this->obfuscationCharacter;
    }
}
