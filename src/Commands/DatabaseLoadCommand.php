<?php

namespace EOA\Ability\Commands;

use EOA\Ability\Services\PermissionsService\PermissionsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DatabaseLoadCommand extends Command
{
    public $signature = 'ability:load {source=local}';

    public $description = 'database load';

    public function handle(): int
    {
        $source = $this->argument('source');
        if ($source == 'local') {
            $permissionsService = new PermissionsService();
            $permissionsService->loadPermissionsFromLocal();
            Log::info("Permissions loaded from local to database");
        }

        return self::SUCCESS;
    }
}
