<?php

namespace EOA\Ability\Commands;

use Illuminate\Console\Command;

class DatabaseLoadCommand extends Command
{
    public $signature = 'ability:databaseload';

    public $description = 'database load';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
