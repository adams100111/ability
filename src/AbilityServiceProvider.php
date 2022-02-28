<?php

namespace EOA\Ability;

use EOA\Ability\Commands\AbilityCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AbilityServiceProvider extends PackageServiceProvider
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
            ->hasMigration('create_ability_table')
            ->hasCommand(AbilityCommand::class);
    }
}
