<?php

namespace EOA\Ability\Traits;

use EOA\Ability\Models\Permission;
use EOA\Ability\Models\Role;

/**
 * HasPermissions Trait
 */
trait HasPermissions
{
    public function permissions()
    {
        return $this->morphOne(Permission::class, 'permissible');
    }

    public function getPermissions()
    {
        return $this->permissions->permissions ?? [];
    }

    public function getRolesModels()
    {
        return collect(array_map(function ($role) {
            return Role::ofName($role);
        }, $this->roles));
    }

    public function getAllPermissions()
    {
        $permissions = $this->getPermissions();
        foreach ($this->getRolesModels() as $role) {
            $permissions = array_merge($permissions, $role->getPermissions());
        }

        return $permissions;
    }

    // Setters & Getters
    public function getRolesAttribute($roles)
    {
        return $roles ? (array) json_decode($roles) : [];
    }

    public function setRolesAttribute($roles)
    {
        $this->attributes['roles'] = json_encode($roles);
    }

    public function hasRole($role)
    {
        if (is_model($role)) {
            $roleName = $role->name;
        } else {
            $roleName = $role;
        }

        return in_array($roleName, $this->roles);
    }

    public function addRole($role)
    {
        if (! $this->hasRole($role)) {
            if (is_model($role)) {
                $roleName = $role->name;
            } else {
                $roleName = $role;
            }

            $roles = $this->roles;
            $roles[] = $roleName;

            return $this->update(['roles' => $roles]);
        }
    }

    public function ableTo($permissions, array $options = [])
    {
        $allPermissions = $this->getAllPermissions();

        $operator = $options['operator'] ?? '||';
        $separator = $options['separator'] ?? '|';
        if (is_array($permissions)) {
            $_permissions = $permissions;
        } elseif (is_string($permissions)) {
            $_permissions = explode($separator, $permissions);
        } else {
            $_permissions = [];
        }

        if ($operator == '||') {
            return count(array_intersect($_permissions, $allPermissions)) > 0;
        } else {
            return count(array_intersect($_permissions, $allPermissions)) === count($_permissions);
        }
    }

    public function removeRole($role)
    {
        if (! $this->hasRole($role)) {
            if (is_model($role)) {
                $roleName = $role->name;
            } else {
                $roleName = $role;
            }

            $roles = array_filter($this->roles, function ($role) use ($roleName) {
                return $role != $roleName;
            });

            return $this->update(['roles' => $roles]);
        }
    }

    public function hasPermission($permission)
    {
        $permissions = $this->permissions;

        return $permissions ? $permissions->hasPermission($permission) : null;
    }

    public function addPermission($permission)
    {
        $permissions = $this->permissions ?? $this->permissions()->create();

        return $permissions->addPermission($permission);
    }

    public function removePermission($permission)
    {
        $permissions = $this->permissions;

        return $permissions ? $permissions->removePermission($permission) : null;
    }
}
