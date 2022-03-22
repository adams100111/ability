<?php

use EOA\Ability\Models\Permission;
use EOA\Ability\Models\Role;
use EOA\Ability\Services\PermissionsService\PermissionsService;
use Illuminate\Support\Facades\Artisan;

it('can check permission', function () {
    $permissionsService = new PermissionsService();
    $localPermissions = $permissionsService->permissions();
    // $roles = Role::factory(30)->create();
    Artisan::call("ability:load");
    expect(Permission::count())->toBe($localPermissions->count());
})->group('permissions');
