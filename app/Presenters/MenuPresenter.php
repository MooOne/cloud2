<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\MenuTransformer;
use Yeelight\Models\Menu;

/**
 * Class MenuPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class MenuPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MenuTransformer();
    }

    public function model()
    {
        return app()->make(Menu::class);
    }

    public function getPermissionTag($tag)
    {
        return $this->model()->getPermissionTag($tag);
    }
    /**
     * 生成菜单排序列表
     * @param $menus
     * @return string
     */
    public function menuNestable($menus)
    {
        if ($menus) {
            $item = '';
            foreach ($menus as $v) {
                $item.= $this->getNestableItem($v);
            }
            return $item;
        }
        return '暂无菜单';
    }

    /**
     * 返回菜单HTML代码
     * @param $menu
     * @return string
     */
    protected function getNestableItem($menu)
    {
        if ($menu['child']) {
            return $this->getHandleList($menu['menu_id'], $menu['name'], $menu['icon'], $menu['child']);
        }
        $labelInfo = $menu['pid'] == 0 ?  'text-success':'text-warning';
        return <<<Eof
				<li class="dd-item dd3-item" data-id="{$menu['menu_id']}">
                    <div class="dd-handle dd3-handle">Drag</div>
                    <div class="dd3-content"><span class="label {$labelInfo}"><i class="{$menu['icon']}"></i></span> {$menu['name']} {$this->getActionButtons($menu['menu_id'])}</div>
                </li>
Eof;
    }

    /**
     * 判断是否有子集
     *
     * @param $id
     * @param $name
     * @param $icon
     * @param $child
     * @return string
     */
    protected function getHandleList($id, $name, $icon, $child)
    {
        $handle = '';
        if ($child) {
            foreach ($child as $v) {
                $handle .= $this->getNestableItem($v);
            }
        }

        $html = <<<Eof
		<li class="dd-item dd3-item" data-id="{$id}">
            <div class="dd-handle dd3-handle">Drag</div>
            <div class="dd3-content">
            	<span class="label text-success"><i class="{$icon}"></i></span> {$name} {$this->getActionButtons($id)}
            </div>
            <ol class="dd-list">
                {$handle}
            </ol>
        </li>
Eof;
        return $html;
    }

    /**
     * 菜单按钮
     * @param $id
     * @return string
     */
    protected function getActionButtons($id)
    {
        $action = '<div class="pull-right">';
        if (auth()->user()->can($this->getPermissionTag('show'))) {
            $action .= '<a href="javascript:;" class="btn btn-xs tooltips showInfo" data-href="'.url('console/menu',[$id]).'" data-toggle="tooltip" data-original-title="'.trans('console/action.actionButton.show').'"  data-placement="top"><i class="fa fa-eye text-success"></i></a>';
        }
        if (auth()->user()->can($this->getPermissionTag('edit'))) {
            $action .= '<a href="javascript:;" data-href="'.url('console/menu/'.$id.'/edit').'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip"data-original-title="'.trans('console/action.actionButton.edit').'"  data-placement="top"><i class="fa fa-pencil text-warning"></i></a>';
        }
        if (auth()->user()->can($this->getPermissionTag('destroy'))) {
            $action .= '<a href="javascript:;" class="btn btn-xs tooltips destroy_item" data-id="'.$id.'" data-original-title="'.trans('console/action.actionButton.destroy').'"data-toggle="tooltip"  data-placement="top"><i class="fa fa-trash text-danger"></i></i><form action="'.url('console/menu',[$id]).'" method="POST" style="display:none"><input type="hidden"name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form></a>';
        }
        $action .= '</div>';
        return $action;
    }

    /**
     * 根据用户不同的权限显示不同的内容
     *
     * @return string
     */
    public function canCreateMenu()
    {
        $canCreateMenu = auth()->user()->can($this->getPermissionTag('create'));

        $title = $canCreateMenu ?  trans('console/menu.welcome'):trans('console/menu.sorry');
        $desc = $canCreateMenu ? trans('console/menu.description'):trans('console/menu.description_sorry');
        $createButton = $canCreateMenu ? '<br><a href="javascript:;" class="btn btn-primary m-t create_menu">'.trans('console/menu.action.create').'</a>':'';
        return <<<Eof
		<div class="middle-box text-center animated fadeInRightBig">
            <h3 class="font-bold">{$title}</h3>
            <div class="error-desc">
                {$desc}{$createButton}
            </div>
        </div>
Eof;
    }

    /**
     * 添加修改菜单关系select
     *
     * @param $menus
     * @param string $pid
     * @return string
     */
    public function topMenuList($menus, $pid = '')
    {
        $html = '<option value="0">'.trans('console/menu.topMenu').'</option>';
        if ($menus) {
            foreach ($menus as $v) {
                $html .= '<option value="'.$v['menu_id'].'" '.$this->checkMenu($v['menu_id'],$pid).'>'.$v['name'].'</option>';
            }
        }
        return $html;
    }

    public function checkMenu($menuId, $pid)
    {
        if ($pid !== '') {
            if ($menuId == $pid) {
                return 'selected = "selected"';
            }
            return '';
        }
        return '';
    }

    /**
     * 获取菜单关系名称
     * @param $menus
     * @param $pid
     * @return string
     */
    public function topMenuName($menus, $pid)
    {
        if ($pid == 0) {
            return '顶级菜单';
        }
        if ($menus) {
            foreach ($menus as $v) {
                if ($v['menu_id'] == $pid) {
                    return $v['name'];
                }
            }
        }
        return '';
    }

    /**
     * 后台左侧菜单
     * @param $sidebarMenus
     * @return string
     */
    public function sidebarMenuList($sidebarMenus)
    {
        $html = '';
        if ($sidebarMenus) {
            foreach ($sidebarMenus as $menu) {
                if (!auth()->user()->can($menu['slug'])) {
                    continue;
                }
                if ($menu['child']) {
                    $active = active_class(if_uri_pattern(explode(',', $menu['active'])),'active');
                    $url = url($menu['url']);
                    $html .= <<<Eof
					<li class="{$active}">
			          	<a href="{$url}"><i class="{$menu['icon']}"></i> <span class="nav-label">{$menu['name']}</span> <span class="fa arrow"></span></a>
			          	<ul class="nav nav-second-level collapse">
			              	{$this->childMenu($menu['child'])}
			          	</ul>
			      	</li>
Eof;
                }else{
                    $html .= '<li class="'.active_class(if_uri_pattern(explode(',',$menu['active'])),'active').'"><a href="'.url($menu['url']).'"><i class="'.$menu['icon'].'"></i> <span class="nav-label">'.$menu['name'].'</span></a></li>';
                }
            }
        }
        return $html;
    }

    /**
     * 多级菜单显示
     * @param $childMenu
     * @return string
     */
    public function childMenu($childMenu)
    {
        $html = '';
        if ($childMenu) {
            foreach ($childMenu as $v) {
                $html .= '<li class="'.active_class(if_uri_pattern(explode(',',$v['active'])),'active').'"><a href="'.url($v['url']).'">'.$v['name'].'</a></li>';
            }
        }
        return $html;
    }
}
