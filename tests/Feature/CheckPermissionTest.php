<?php

use EOA\Ability\Facades\Ability;
use EOA\Ability\Services\PermissionsService\PermissionsService;

it('can check permission', function () {
    $permissionsService = new PermissionsService();
    $localPermissions = $permissionsService->permissions();
    $databasePermissionsPermissions = $permissionsService->loadPermissionsFromLocal();

    
});
