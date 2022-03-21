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
            // ->hasMigration('create_ability_table')
            ->hasRoutes('web')
            ->hasCommands([AbilityCommand::class]);
    }

    public function register()
    {
        parent::register();

        $this->app->bind('ability', fn () => new Ability());

        $this->app->register(AbilitySourceServiceProvider::class);
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
