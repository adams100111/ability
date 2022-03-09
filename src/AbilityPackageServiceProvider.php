<?php

namespace EOA\Ability;

use EOA\Ability\Commands\AbilityCommand;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AbilityPackageServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ability')
            ->hasConfigFile()
            ->hasViews()
            // ->hasMigration('create_ability_table')
            ->hasRoutes('web')
            ->hasCommands([AbilityCommand::class]);
    }
}