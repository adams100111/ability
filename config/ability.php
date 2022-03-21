<?php
// config for EOA/Ability
return [

    /*
    |--------------------------------------------------------------------------
    | Permissions Source
    |--------------------------------------------------------------------------
    |
    | The string source that determines the permissions source to use while
    | fetching permissions. You may change the value to correspond to one of
    | this sources [config file, database table].
    |
    */
    'source' => 'file',

    'models' => [
        'role' => \EOA\Ability\Models\Role::class,
        'permission' => \EOA\Ability\Models\Permission::class,
        'permissible' => \EOA\Ability\Models\Permissible::class,
    ],

    'permissions_structure' => [
        'permissions' => [
            'global.attachments.create',
            'global.attachments.read',
            'global.attachments.update',
            'global.attachments.delete',
            'global.procedures.create',
            'global.procedures.read',
            'global.procedures.update',
            'global.procedures.delete',
        ],
        'modules' => [
            'auth' => [
                'groups' => [
                    'users' => 'create|read|update|delete|print',
                    'roles' => 'create|read|update|delete|print',
                ]
            ],
            'accounting' => [
                'groups' => [
                    'accounts' => 'create|read|update|delete|print',
                    'years' => 'create|read|update|delete|print',
                    'entries' => 'create|read|update|delete|print',
                ]
            ]
        ],
    ],
];
