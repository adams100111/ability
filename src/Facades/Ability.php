<?php

namespace EOA\Ability\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EOA\Ability\Ability
 */
class Ability extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ability';
    }
}
