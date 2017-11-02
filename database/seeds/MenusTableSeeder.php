<?php
use Illuminate\Database\Seeder;
use Yeelight\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $index = new Menu;
        $index->name = "控制台";
        $index->pid = 0;
        $index->icon = "fa fa-dashboard";
        $index->slug = "console.index";
        $index->url = "console/index";
        $index->active = "console/index";
        $index->description = "后台首页";
        $index->save();

        /**
         * -------------------------------------------------
         * 系统管理
         * -------------------------------------------------
         */
        $system = new Menu;
        $system->name = "系统管理";
        $system->pid = 0;
        $system->icon = "fa fa-cog";
        $system->slug = "system.manage";
        $system->url = "";
        $system->active = "console/role*,console/permission*,console/user*,console/menu*,console/log*";
        $system->description = "系统功能管理";
        $system->save();

        $user = new Menu;
        $user->name = "用户管理";
        $user->pid = $system->id;
        $user->icon = "fa fa-users";
        $user->slug = "user.list";
        $user->url = "console/user";
        $user->active = "console/user*";
        $user->description = "显示用户管理";
        $user->save();


        $role = new Menu;
        $role->name = "角色管理";
        $role->pid = $system->id;
        $role->icon = "fa fa-male";
        $role->slug = "role.list";
        $role->url = "console/role";
        $role->active = "console/role*";
        $role->description = "显示角色管理";
        $role->save();


        $permission = new Menu;
        $permission->name = "权限管理";
        $permission->pid = $system->id;
        $permission->icon = "fa fa-paper-plane";
        $permission->slug = "permission.list";
        $permission->url = "console/permission";
        $permission->active = "console/permission*";
        $permission->description = "显示权限管理";
        $permission->save();

        $menu = new Menu;
        $menu->name = "菜单管理";
        $menu->pid = $system->id;
        $menu->icon = "fa fa-navicon";
        $menu->slug = "menu.list";
        $menu->url = "console/menu";
        $menu->active = "console/menu*";
        $menu->description = "显示菜单管理";
        $menu->save();

        $log = new Menu;
        $log->name = "系统日志";
        $log->pid = $system->id;
        $log->icon = "fa fa-file-text-o";
        $log->slug = "log.all";
        $log->url = "console/log";
        $log->active = "console/log*";
        $log->description = "显示系统日志";
        $log->save();
    }
}
