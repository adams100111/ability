<?php

namespace EOA\Ability;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;

class AbilitySourceServiceProvider extends ServiceProvider
{
    public function boot()
    {
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
