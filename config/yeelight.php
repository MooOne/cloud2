<?php
/**
 * Yeelight 自定义配置
 */
return [
    'backend' => [
        /*
        * System name.
        */
        'name'  => 'Yeelight Cloud',

        /*
         * Logo in admin panel header.
         */
        'logo'      => '<b>Yeelight</b> Cloud',

        /*
         * Mini-logo in admin panel header.
         */
        'logo-mini' => '<b>Yee</b>',

        /*
        * backend html title.
        */
        'title'  => '售后管理系统',

        /*
         * Use `https`.
         */
        'secure' => env('APP_SECURE', false),

        /*
        * Route configration.
        */
        'route' => [

            'prefix' => 'backend',

            'namespace'     => 'Backend',

            'middleware'    => ['web', 'admin'],
        ],

        /*
        * database setting.
        */
        'database' => [

            // Database connection for following tables.
            'connection'  => '',

            // User tables and model.
            'users_table' => 'admin_users',
            'users_model' => Encore\Admin\Auth\Database\Administrator::class,

            // Role table and model.
            'roles_table' => 'admin_roles',
            'roles_model' => Encore\Admin\Auth\Database\Role::class,

            // Permission table and model.
            'permissions_table' => 'admin_permissions',
            'permissions_model' => Encore\Admin\Auth\Database\Permission::class,

            // Menu table and model.
            'menu_table'  => 'admin_menu',
            'menu_model'  => Encore\Admin\Auth\Database\Menu::class,

            // Pivot table for table above.
            'operation_log_table'    => 'admin_operation_log',
            'user_permissions_table' => 'admin_user_permissions',
            'role_users_table'       => 'admin_role_users',
            'role_permissions_table' => 'admin_role_permissions',
            'role_menu_table'        => 'admin_role_menu',
        ],

        /*
         * By setting this option to open or close operation log in laravel-admin.
         */
        'operation_log'   => [

            'enable' => true,

            /*
             * Routes that will not log to database.
             *
             * All method to path like: admin/auth/logs
             * or specific method to path like: get:admin/auth/logs
             */
            'except' => [
                'admin/auth/logs*',
            ],
        ],

        /*
         * @see https://adminlte.io/docs/2.4/layout
         */
        'skin'    => 'skin-blue',

        /*
        |---------------------------------------------------------|
        |LAYOUT OPTIONS | fixed                                   |
        |               | layout-boxed                            |
        |               | layout-top-nav                          |
        |               | sidebar-collapse                        |
        |               | sidebar-mini                            |
        |---------------------------------------------------------|
         */
        'layout'  => ['sidebar-mini'],

        /*
         * Version displayed in footer.
         */
        'version'   => '1.0.0',

        /*
         * Settings for extensions.
         */
        'extensions' => [

        ],

    ],
    'mobile' => [
        /*
        * Route configration.
        */
        'route' => [

            'prefix' => 'm',

            'namespace'     => 'Mobile',
        ],
    ]
];