<?php

namespace EOA\Ability\Services\PermissionsService;

use EOA\Ability\Services\PermissionsService\Entities\Permission;

class PermissionsService
{
    public $module;
    public $group;

    public function __construct(array $params = [])
    {
        $this->module = $params['module'] ?? null;
        $this->group = $params['group'] ?? null;
    }

    public function permissions()
    {
        $path = "ability.permissions_structure.modules";
        $path .= $this->module ? ".{$this->module}" : "";
        $path .= $this->module && $this->group ? ".groups.{$this->group}" : "";
        $modules = config($path);
        $permissions = [];

        if ($this->module && $this->group) {
            $module = $this->module;
            $group = $this->group;
            foreach ($modules as $_operations) {
                $operations = exploding([',', '|'], $_operations);
                foreach ($operations as $operation) {
                    $permissions[] = new Permission(compact('operation', 'module', 'group'));
                }
            }
        } elseif ($this->module && is_null($this->group)) {
            $module = $this->module;
            foreach ($modules as $group => $_operations) {
                $operations = exploding([',', '|'], $_operations);
                foreach ($operations as $operation) {
                    $permissions[] = new Permission(compact('operation', 'module', 'group'));
                }
            }
        } else {
            $permissions = array_map(fn($permissionName) => Permission::ofName($permissionName), config("ability.permissions_structure.permissions"));
            foreach (config("ability.permissions_structure.permissions") as $permission => $data) {
                if (is_string($permission)) {
                    $parts = explode('.', $permission);
                    $operations = exploding([',', '|'], $permission);
                    $module = $parts[0];
                    $group = $parts[1];
                    foreach ($operations as $operation) {
                        $permissions[] = new Permission(compact('operation', 'module', 'group'));
                    }
                }else{
                    $permissions[] = Permission::ofName($data);
                }
            }

            foreach ($modules as $module => $moduleData) {
                $group = $this->group;
                if ($group) {
                    $group_operations = $moduleData['groups'][$group] ?? null;
                    $operations = $group_operations ? exploding([',', '|'], $group_operations) : [];
                    foreach ($operations as $operation) {
                        $permissions[] = new Permission(compact('operation', 'module', 'group'));
                    }
                } else {
                    foreach (($moduleData['groups'] ?? []) as $group => $_operations) {
                        $operations = exploding([',', '|'], $_operations);
                        foreach ($operations as $operation) {
                            $permissions[] = new Permission(compact('operation', 'module', 'group'));
                        }
                    }
                }
            }
        }

        return collect($permissions);
    }

    public static function permission(string $name)
    {
        $parts = explode('.', $name);
        if (count($parts) == 3) {
            $module = $parts[0];
            $group = $parts[1];
            $operation = $parts[2];
            $operations = exploding([',', '|'], (config("ability.permissions_structure.modules.$module.groups.$group") ?? ''));
            if (in_array($operation, $operations)) {
                return new Permission(compact('operation', 'module', 'group'));
            }
        }
    }
}
