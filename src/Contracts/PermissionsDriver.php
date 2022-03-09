<?php

namespace EOA\Ability\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

abstract class PermissionsDriver
{
    protected string $source;
    protected Collection $permissions;

    abstract public static function all(): Collection;

    abstract public function paginate(): LengthAwarePaginator;

    abstract public function where(string $column, $value, string $operator = '='): PermissionsDriver;

    abstract public function getPermissions(): Collection;
}
