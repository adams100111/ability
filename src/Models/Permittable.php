<?php

namespace EOA\Ability\Models;

use EOA\Ability\Services\PermissionsService\PermissionsService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permittable extends Model
{
    use HasFactory; protected $fillable = ['permissions','permissible_type','permissible_id'];

    public function permissible()
    {
        return $this->morphTo();
    }

    public static function schema($params = null)
    {
        if (is_string($params)) {
            return PermissionsService::permission($params);
        }

        return (new PermissionsService($params))->permissions();
    }

    public function hasPermission($permission)
    {

        return in_array($permission, $this->permissions);
    }

    public function addPermission($permission)
    {
        if (!$this->hasPermission($permission)) {
            $permissions = $this->permissions;
            $permissions[] = $permission;

            return $this->update(['permissions' => $permissions]);
        }
    }

    public function removePermission($permission)
    {
        if ($this->hasPermission($permission)) {
            $permissions = array_filter($this->permissions, function($p)use($permission){ return $p != $permission; });

            return $this->update(['permissions' => $permissions]);
        }
    }

    // Setters & Getters
    public function getPermissionsAttribute($permissions)
    {
        return $permissions ? (array) json_decode($permissions) : [];
    }


    public function setPermissionsAttribute($permissions)
    {
        $this->attributes['permissions'] = json_encode($permissions);
    }
}
