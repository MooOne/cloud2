<?php
/**
 * Yeelight 自定义配置.
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
        'title'  => 'Yeelight Cloud',

        /*
         * Use `https`.
         */
        'secure' => env('APP_SECURE', false),

        /*
        * backend auth setting.
        */
        'auth' => [
            'guards' => [
                'backend' => [
                    'driver'   => 'session',
                    'provider' => 'backend',
                ],
            ],

            'providers' => [
                'backend' => [
                    'driver' => 'eloquent',
                    'model'  => Yeelight\Models\AdminUser::class,
                ],
            ],
            'super_role' => 'administrator',
        ],

        /*
        * Route configration.
        */
        'route' => [

            'prefix' => 'backend',

            'namespace'     => 'Backend',

            'middleware'    => ['web', 'backend'],
        ],

        /*
        * Auth Route configration.
        */
        'auth_route' => [

            'prefix' => 'backend/auth',

            'namespace'     => 'BackendAuth',

            'middleware'    => ['web', 'backend'],
        ],

        /*
        * GEETEST switch
        */
        'geetest' => env('GEETEST', false),

        /*
        * database setting.
        */
        'database' => [

            // Database connection for following tables.
            'connection'  => '',

            // User tables and model.
            'admin_users_table' => 'admin_users',
            'admin_users_model' => Yeelight\Models\AdminUser::class,

            // Role table and model.
            'admin_roles_table' => 'admin_roles',
            'admin_roles_model' => Yeelight\Models\AdminRole::class,

            // Permission table and model.
            'admin_permissions_table' => 'admin_permissions',
            'admin_permissions_model' => Yeelight\Models\AdminPermission::class,

            // Menu table and model.
            'admin_menus_table'  => 'admin_menus',
            'admin_menus_model'  => Yeelight\Models\AdminMenu::class,

            // Pivot table for table above.
            'admin_operation_logs_table'    => 'admin_operation_logs',
            'admin_user_permissions_table'  => 'admin_user_permissions',
            'admin_role_users_table'        => 'admin_role_users',
            'admin_role_permissions_table'  => 'admin_role_permissions',
            'admin_role_menus_table'        => 'admin_role_menus',
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
        * upload setting.
        */
        'upload'  => [

            'disk' => 'local',

            'directory'  => [
                'image'  => 'image',
                'file'   => 'file',
            ],

            'host' => 'https://yeelight-cloud.b0.upaiyun.com/',
        ],

        'pagination' => [
            'per_page' => 20,
            'pageName' => 'page',
        ],

        /*
         * Settings for tools.
         */
        'tools' => [
            'api-tester' => [

                // route prefix for APIs
                'prefix' => 'api',

                // auth guard for api
                'guard'  => 'api',

                // If you are not using the default user model as the authentication model, set it up
                'user_retriever' => function ($id) {
                    return Yeelight\User::find($id);
                },
            ],
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
    ],
];
