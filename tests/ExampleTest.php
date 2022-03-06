<?php

use EOA\Ability\Facades\Ability;
use Illuminate\Support\Facades\Artisan;

it('can test', function () {
    Artisan::call('ability:source config');
    dd(Ability::check('sajhfdg'));
    expect('jh')->toBe('jh');
});
