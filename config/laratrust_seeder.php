<?php

return [
    'role_structure' => [
        'admin' => [
            'role'          => 'l,r,c,s,e,u,d',
            'permission'    => 'l,r,c,s,e,u,d',
            'user'          => 'l,r,c,s,e,u,d',
            'menu'          => 'l,r,c,s,e,u,d'
        ]
    ],
    'permission_structure' => [
        'admin' => [
            'role'          => 'l,r,c,s,e,u,d',
            'permission'    => 'l,r,c,s,e,u,d',
            'user'          => 'l,r,c,s,e,u,d',
            'menu'          => 'l,r,c,s,e,u,d'
        ],
    ],
    'permissions_map' => [
        'l'     => 'list',
        'r'     => 'show',
        'c'     => 'create',
        's'     => 'store',
        'e'     => 'edit',
        'u'     => 'edit',
        'd'     => 'destroy'
    ]
];
