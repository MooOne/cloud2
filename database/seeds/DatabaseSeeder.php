<?php

use Illuminate\Database\Seeder;
use Yeelight\Models\AdminMenu;
use Yeelight\Models\AdminPermission;
use Yeelight\Models\AdminRole;
use Yeelight\Models\AdminUser;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        AdminUser::truncate();
        AdminUser::create([
            'username' => 'admin',
            'password' => 'admin',
            'name'     => '超级管理员',
        ]);

        // create a role.
        AdminRole::truncate();
        AdminRole::create([
            'name' => '超级管理员',
            'slug' => 'administrator',
        ]);

        // add role to user.
        AdminUser::first()->roles()->save(AdminRole::first());

        //create a permission
        AdminPermission::truncate();
        AdminPermission::insert([
            [
                'name'        => '所有权限',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ],
            [
                'name'        => '控制面板',
                'slug'        => 'dashboard',
                'http_method' => 'GET',
                'http_path'   => '/',
            ],
            [
                'name'        => '登录',
                'slug'        => 'auth.login',
                'http_method' => '',
                'http_path'   => "/auth/login\r\n/auth/logout",
            ],
            [
                'name'        => '个人资料',
                'slug'        => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path'   => '/auth/setting',
            ],
            [
                'name'        => '角色权限管理',
                'slug'        => 'auth.management',
                'http_method' => '',
                'http_path'   => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
            ],
            [
                'name' => '日志查看器',
                'slug' => 'tools.log-viewer',
                'http_method' => '',
                'http_path' => "/tools/logs*",
            ],
            [
                'name' => '计划任务',
                'slug' => 'tools.scheduling',
                'http_method' => '',
                'http_path' => "/tools/scheduling*",
            ],
            [
                'name' => '数据库终端',
                'slug' => 'tools.terminal.database',
                'http_method' => '',
                'http_path' => "/tools/terminal/database*",
            ],
            [
                'name' => 'Aritsan终端',
                'slug' => 'tools.terminal.artisan',
                'http_method' => '',
                'http_path' => "/tools/terminal/artisan*",
            ],
            [
                'name' => '脚手架',
                'slug' => 'tools.scaffold',
                'http_method' => '',
                'http_path' => "/tools/scaffold*",
            ],
            [
                'name' => '路由查看器',
                'slug' => 'tools.routes',
                'http_method' => '',
                'http_path' => "/tools/routes*",
            ],
            [
                'name' => 'Api tester',
                'slug' => 'tools.api-tester',
                'http_method' => '',
                'http_path' => "/tools/api-tester*",
            ],
        ]);

        AdminRole::first()->permissions()->save(AdminPermission::first());

        // add default menus.
        AdminMenu::truncate();
        AdminMenu::insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => '控制面板',
                'icon'      => 'fa-bar-chart',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => '管理',
                'icon'      => 'fa-tasks',
                'uri'       => '',
            ],
            [
                'parent_id' => 2,
                'order'     => 3,
                'title'     => '用户',
                'icon'      => 'fa-users',
                'uri'       => 'auth/users',
            ],
            [
                'parent_id' => 2,
                'order'     => 4,
                'title'     => '角色',
                'icon'      => 'fa-user',
                'uri'       => 'auth/roles',
            ],
            [
                'parent_id' => 2,
                'order'     => 5,
                'title'     => '权限',
                'icon'      => 'fa-ban',
                'uri'       => 'auth/permissions',
            ],
            [
                'parent_id' => 2,
                'order'     => 6,
                'title'     => '后台菜单',
                'icon'      => 'fa-bars',
                'uri'       => 'auth/menus',
            ],
            [
                'parent_id' => 2,
                'order'     => 7,
                'title'     => '操作记录',
                'icon'      => 'fa-history',
                'uri'       => 'auth/logs',
            ],
            [
                'parent_id' => 0,
                'order' => 8,
                'title' => '工具',
                'icon' => 'fa-gears',
                'uri' => '#',
            ],
            [
                'parent_id' => 8,
                'order' => 9,
                'title' => '日志查看器',
                'icon' => 'fa-bug',
                'uri' => 'tools/logs',
            ],
            [
                'parent_id' => 8,
                'order' => 14,
                'title' => '计划任务',
                'icon' => 'fa-clock-o',
                'uri' => 'tools/scheduling',
            ],
            [
                'parent_id' => 8,
                'order' => 13,
                'title' => '脚手架',
                'icon' => 'fa-keyboard-o',
                'uri' => 'tools/scaffold',
            ],
            [
                'parent_id' => 8,
                'order' => 12,
                'title' => '数据库终端',
                'icon' => 'fa-database',
                'uri' => 'tools/terminal/database',
            ],
            [
                'parent_id' => 8,
                'order' => 11,
                'title' => 'Artisan终端',
                'icon' => 'fa-terminal',
                'uri' => 'tools/terminal/artisan',
            ],
            [
                'parent_id' => 8,
                'order' => 10,
                'title' => '路由查看器',
                'icon' => 'fa-list-alt',
                'uri' => 'tools/routes',
            ],
            [
                'parent_id' => 0,
                'order' => 15,
                'title' => '用户管理',
                'icon' => 'fa-user-circle',
                'uri' => '',
            ],
            [
                'parent_id' => 15,
                'order' => 16,
                'title' => '用户管理',
                'icon' => 'fa-user-o',
                'uri' => 'consumer/users',
            ],
            [
                'parent_id' => 0,
                'order' => 17,
                'title' => '产品管理',
                'icon' => 'fa-product-hunt',
                'uri' => '',
            ],
            [
                'parent_id' => 17,
                'order' => 18,
                'title' => '产品模型',
                'icon' => 'fa-lightbulb-o',
                'uri' => 'product/product_models',
            ],
        ]); 

        // add role to menu.
        AdminMenu::find(2)->roles()->save(AdminRole::first());
    }
}
