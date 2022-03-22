<?php

namespace EOA\Ability\Commands;

use Illuminate\Console\Command;

class AbilityCommand extends Command
{
    public $signature = 'ability';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
