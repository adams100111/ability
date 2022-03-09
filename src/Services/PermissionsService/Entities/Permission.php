<?php

namespace EOA\Ability\Services\PermissionsService\Entities;

class Permission
{
    public $name;
    public $operation;
    public $module;
    public $group;

    public function __construct(array $params = [])
    {
        $this->operation = $params['operation'] ?? null;
        $this->module = $params['module'] ?? null;
        $this->group = $params['group'] ?? null;

        $this->name = $this->name();
    }

    public function name()
    {
        $name = "";
        $name .= $this->module ? "{$this->module}." : '';
        $name .= $this->group ? "{$this->group}." : '';
        $name .= $this->operation ? "{$this->operation}" : '';

        return $name;
    }
}
