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
        $path = "permissions.modules";
        $path .= $this->module ? ".{$this->module}" : "";
        $path .= $this->module && $this->group ? ".groups.{$this->group}" : "";
        $modules = config($path);
        $permissions = [];

        if ($this->module && $this->group) {
            $module = $this->module;
            $group = $this->group;
            foreach ($modules as $_operations) {
                $operations = explode(',', $_operations);
                foreach ($operations as $operation) {
                    $permissions[] = new Permission(compact('operation', 'module', 'group'));
                }
            }
        } else if ($this->module && is_null($this->group)) {
            $module = $this->module;
            foreach ($modules as $group => $_operations) {
                $operations = explode(',', $_operations);
                foreach ($operations as $operation) {
                    $permissions[] = new Permission(compact('operation', 'module', 'group'));
                }
            }
        } else {
            foreach ($modules as $module => $moduleData) {
                $group = $this->group;
                if ($group) {
                    $group_operations = $moduleData['groups'][$group] ?? null;
                    $operations = $group_operations ? explode(',', $group_operations) : [];
                    foreach ($operations as $operation) {
                        $permissions[] = new Permission(compact('operation', 'module', 'group'));
                    }
                } else {
                    foreach (($moduleData['groups'] ?? []) as $group => $_operations) {
                        $operations = explode(',', $_operations);
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
            $operations = explode(',', (config("permissions.modules.$module.groups.$group") ?? ''));
            if (in_array($operation, $operations)) {
                return new Permission(compact('operation', 'module', 'group'));
            }
        }
    }
}

