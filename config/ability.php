<?php
// config for EOA/Ability
return [
    'source' => 'config',
    'permissions' => [],
    'routes' => [
        'role' => [
            'index' => 'ability.role.index',
            'edit' => 'ability.role.edit',
            'show' => 'ability.role.show',
            'create' => 'ability.role.create',
            'update' => 'ability.role.update',
            'delete' => 'ability.role.delete',
        ]
    ]
];
