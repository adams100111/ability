<?php

use EOA\Ability\Facades\Ability;

it('can check permission', function () {
    dd(collect([2,4,6,8,10])->paginate(3, page: 2));
    // expect(Ability::check('sajhfdg'))->toBeTrue();
});
