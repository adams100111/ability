<?php

namespace EOA\Ability;

use Illuminate\Support\Facades\Config;

class Ability
{
    public function check($permissions)
    {
        return $permissions;
    }

    public function source($newValue = null)
    {
        $source = Config::get('ability.source');
        if ($source == $newValue) {
            return $source;
        }

        Config::set('ability.source', $newValue);

        return $newValue;
    }
}
