<?php
namespace EOA\Ability\Drivers\Permissions;

use EOA\Ability\Contracts\PermissionsDriver;
use Illuminate\Database\Eloquent\Collection;

class FileDriver extends PermissionsDriver
{
    protected $source = 'file';

    public static function all()
    {
        $permissions = config('ability.permissions');
    }

    public function where(string $column, $value, string $operator = '='): PermissionsDriver
    {

        return $this;
    }
}

