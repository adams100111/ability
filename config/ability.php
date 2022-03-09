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
    'source' => 'config',

    'permissions_structure' => [
        'permissions' => [
            'global.attachments' => 'create|read|update|delete|print',
            'global.procedures.create',
            'global.procedures.read',
            'global.procedures.update',
            'global.procedures.delete',
        ],
        'modules' => [
            'auth' => [
                'users' => 'create|read|update|delete|print',
                'roles' => 'create|read|update|delete|print',
            ],
            'accounting' => [
                'accounts' => 'create|read|update|delete|print',
                'years' => 'create|read|update|delete|print',
                'entries' => 'create|read|update|delete|print',
            ]
        ],
    ],
];
