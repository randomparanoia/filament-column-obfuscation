<?php

namespace rndparanoia\FilamentColumnObfuscation\Commands;

use Illuminate\Console\Command;

class FilamentColumnObfuscationCommand extends Command
{
    public $signature = 'filament-column-obfuscation';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
