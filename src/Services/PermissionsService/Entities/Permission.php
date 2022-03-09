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
        $this->name = $params['name'] ?? $this->name();
        
        $this->module = $params['module'] ?? $this->module();
        $this->group = $params['group'] ?? $this->group();
        $this->operation = $params['operation'] ?? $this->operation();
    }

    public function name()
    {
        $name = "";
        $name .= $this->module ? "{$this->module}." : '';
        $name .= $this->group ? "{$this->group}." : '';
        $name .= $this->operation ? "{$this->operation}" : '';

        return $name;
    }

    public function module()
    {
        if ($this->module) {
            return $this->module;
        }

        if (count($names = explode('.', $this->name)) >= 3) {
            return $names[0];
        }
    }

    public function group()
    {
        if ($this->group) {
            return $this->group;
        }

        if (count($names = explode('.', $this->name)) >= 3) {
            return $names[1];
        }
    }

    public function operation()
    {
        if ($this->operation) {
            return $this->operation;
        }

        if (count($names = explode('.', $this->name)) >= 3) {
            return $names[2];
        }
    }

    public function withName(string $name) :Permission
    {
        $this->name = $name;
        return $this;
    }

    public static function ofName(string $name) :Permission
    {
        return new static(compact('name'));
    }
}
