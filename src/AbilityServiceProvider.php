<?php

namespace EOA\Ability;

use EOA\Ability\Commands\AbilityCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AbilityServiceProvider extends PackageServiceProvider
{
    // public function register()
    // {
    //     $this->app->bind('ability', function($app) {
    //         return new Ability();
    //     });
    // }

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

        $this->app->bind('ability', fn () => new Ability());
    }

    public function register()
    {
        $this->publishResources();
    }

    protected function publishResources()
    {
        $this->publishes([
            __DIR__ . '/../config/ability.php' => config_path('ability.php'),
        ], 'ability-config');

        $this->publishes([
            __DIR__ . '/../database/migrations/create_roles_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_roles_table.php'),
            __DIR__ . '/../database/migrations/create_permissions_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_permissions_table.php'),
            __DIR__ . '/../database/migrations/create_permittables_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_permittables_table.php'),
        ], 'ability-migrations');

        $this->publishes([
            __DIR__ . '/../database/seeds/AbilitySeeder.php' => database_path('seeds/AbilitySeeder.php'),
        ], 'ability-seeds');
    }
}
