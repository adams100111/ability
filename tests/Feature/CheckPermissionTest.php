<?php

use EOA\Ability\Facades\Ability;
use EOA\Ability\Services\PermissionsService\PermissionsService;

it('can check permission', function () {
    $permissionsService = new PermissionsService();
    dd($permissionsService->permissions());
    // dd(collect([2,4,6,8,10])->paginate(3, page: 2));
    // expect(Ability::check('sajhfdg'))->toBeTrue();
});
