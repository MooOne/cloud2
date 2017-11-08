<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 17-11-7
 * Time: 下午4:55
 */
namespace Yeelight\Composers;

use Illuminate\View\View;
use Yeelight\Repositories\Interfaces\MenuRepository;

class MenuComposer
{

    protected $menu;


    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
    }


    public function compose(View $view)
    {
        $view->with('sidebarMenu', $this->menu->getMenuList());
    }
}