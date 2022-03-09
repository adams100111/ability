<?php

namespace EOA\Ability\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'display_name'
    ];

    public function permissions()
    {
        return $this->morphOne(Permission::class, 'permissible');
    }

    public function getPermissions()
    {
        return $this->permissions->permissions ?? [];
    }


    public static function ofName($name)
    {
        return static::where('name', $name)->first();
    }

    public function ableTo($permissions, array $options = [])
    {
        $rolePermissions = $this->getPermissions();

        $operator = $options['operator'] ?? '||';
        $separator = $options['separator'] ?? '|';
        if (is_array($permissions)) {
            $_permissions = $permissions;
        }
        elseif (is_string($permissions)) {
            $_permissions = explode($separator, $permissions);
        } else {
            $_permissions = [];
        }

        if ($operator == '||') {
            return count(array_intersect($_permissions, $rolePermissions)) > 0;
        } else {
            return count(array_intersect($_permissions, $rolePermissions)) === count($_permissions);
        }

    }

    public function update(array $attributes = [], array $options = [])
    {
        $filteredAttributes = array_filter($attributes, function($value, $key){
            return isset($value) && !empty($value) && $key != 'name';
        });
        return parent::update($filteredAttributes, $options);
    }

    public static function create(array $attributes = [])
    {
        if (!array_key_exists('name', $attributes)) {
            $attributes['name'] = \Str::random(10);
        }

        return static::query()->create(array_filter($attributes));
    }

    public static function super()
    {
        $query = static::where('name', 'super');
        $role = $query->first() ?? static::firstOrCreate([
            'name' => 'super',
            'display_name' => 'super',
        ]);
        if ($role) {
            $role->permissions()->create(['permissions' => permissions()]);
        }
        return $role;
    }
}
