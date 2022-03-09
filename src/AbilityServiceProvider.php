<?php

namespace EOA\Ability;

use EOA\Ability\Commands\AbilityCommand;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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
    }

    public function register()
    {
        parent::register();

        $this->app->bind('ability', fn () => new Ability());
        $this->publishResources();

        Collection::macro('paginate', function ($perPage = 10, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
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
