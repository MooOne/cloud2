<?php

return [
    'role_structure' => [
        'admin' => [
            'console'       => 'i',
            'system'        => 'm',
            'log'           => 'a',
            'role'          => 'l,r,c,s,e,u,d',
            'permission'    => 'l,r,c,s,e,u,d',
            'user'          => 'l,r,c,s,e,u,d',
            'menu'          => 'l,r,c,s,e,u,d'
        ]
    ],
    'permission_structure' => [
        'admin' => [
            'console'       => 'i',
            'system'        => 'm',
            'log'           => 'a',
            'role'          => 'l,r,c,s,e,u,d',
            'permission'    => 'l,r,c,s,e,u,d',
            'user'          => 'l,r,c,s,e,u,d',
            'menu'          => 'l,r,c,s,e,u,d'
        ],
    ],
    'permissions_map' => [
        'i'     => 'index',
        'm'     => 'manage',
        'a'     => 'all',
        'l'     => 'list',
        'r'     => 'show',
        'c'     => 'create',
        's'     => 'store',
        'e'     => 'edit',
        'u'     => 'edit',
        'd'     => 'destroy'
    ]
];
