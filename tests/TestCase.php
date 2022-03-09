<?php

namespace EOA\Ability\Tests;

use EOA\Ability\AbilityServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'EOA\\Ability\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            AbilityServiceProvider::class,
        ];

        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $rolesMigration = include __DIR__.'/../database/migrations/create_roles_table.php.stub';
        $rolesMigration->up();

        $permissionsMigration = include __DIR__.'/../database/migrations/create_permissions_table.php.stub';
        $permissionsMigration->up();

        $permittablesMigration = include __DIR__.'/../database/migrations/create_permittables_table.php.stub';
        $permittablesMigration->up();
        */
    }
}
