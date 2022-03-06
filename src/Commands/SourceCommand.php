<?php

namespace EOA\Ability\Commands;

use Illuminate\Console\Command;

class SourceCommand extends Command
{
    public $signature = 'ability:source {source}';

    public $description = 'My command';

    public function handle(): int
    {
        $source = $this->argument('source');
        dd($source);
        return self::SUCCESS;
    }
}
