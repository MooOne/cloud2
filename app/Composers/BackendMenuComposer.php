<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-04-02
 * Time: 下午4:55
 */
namespace Yeelight\Composers;

use Illuminate\View\View;
use Yeelight\Models\AdminMenu;

class BackendMenuComposer
{
    public function compose(View $view)
    {
        $view->with('backendMenus', (new AdminMenu())->toTree());
    }
}