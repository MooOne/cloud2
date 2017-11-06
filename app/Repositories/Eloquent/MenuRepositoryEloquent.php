<?php
namespace Yeelight\Repositories\Eloquent;

use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\MenuRepository;
use Yeelight\Models\Menu;
use Yeelight\Validators\MenuValidator;
use Yeelight\Presenters\MenuPresenter;
use Illuminate\Support\Facades\DB;

/**
 * Class MenuRepositoryEloquent
 * @package namespace Yeelight\Repositories\Eloquent;
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MenuValidator::class;
    }


    /**
    * Specify Presenter class name
    *
    * @return mixed
    */
    public function presenter()
    {

        return MenuPresenter::class;
    }

    /**
     * 获取所有菜单
     * @return mixed
     */
    public function allMenus()
    {
        return $this->orderBy('sort','desc')->skipPresenter()->get()->toArray();
    }

    /**
     * 递归菜单数据
     *
     * @param $menus
     * @param int $pid
     * @return array|string
     */
    public function sortMenu($menus, $pid = 0)
    {
        $arr = [];
        if (empty($menus)) {
            return '';
        }
        foreach ($menus as $key => $v) {
            if ($v['pid'] == $pid) {
                $arr[$key] = $v;
                $arr[$key]['child'] = self::sortMenu($menus, $v['menu_id']);
            }
        }
        return $arr;
    }

    /**
     * 获取菜单数据
     *
     * @return array|string
     */
    public function getMenuList()
    {
        $menus = $this->allMenus();
        if ($menus) {
            $menuList = $this->sortMenu($menus);
            foreach ($menuList as $key => &$v) {
                if ($v['child']) {
                    $sort = array_column($v['child'], 'sort');
                    array_multisort($sort,SORT_DESC,$v['child']);
                }
            }

            return $menuList;
        }
        return '';
    }

    /**
     * 根据前台nestable数据更新菜单
     * @param $nestableData
     * @return array|bool
     */
    public function orderable($nestableData)
    {
        try {
            $dataArray = json_decode($nestableData,true);
            $menus = array_values($this->getMenuList());
            $menuCount = count($dataArray);
            $bool = false;

            DB::beginTransaction();
            foreach ($dataArray as $k => $v) {
                $sort = $menuCount - $k;
                if (!isset($menus[$k])) {
                    $this->update(['sort' => $sort,'pid' => 0], $v['id']);
                    $bool = true;
                } else {
                    if (isset($menus[$k]['menu_id']) && $v['id'] != $menus[$k]['menu_id']) {
                        $this->update(['sort' => $sort,'pid' => 0], $v['id']);
                        $bool = true;
                    }
                }
                if (isset($v['children']) && !empty($v['children'])) {
                    $childCount = count($v['children']);
                    foreach ($v['children'] as $key => $child) {
                        $chidlSort = $childCount - $key;
                        if (!isset($menus[$k]['child'][$key])) {
                            foreach ($v['children'] as $index => $val) {
                                $reIndex = $childCount - $index;
                                $this->update(['pid' => $v['id'], 'sort' => $reIndex], $val['id']);
                            }
                            $bool = true;
                        }else{
                            if (isset($menus[$k]['child'][$key]) && ($child['id'] != $menus[$k]['child'][$key]['menu_id'])) {
                                $this->update(['pid' => $v['id'],'sort' => $chidlSort],$child['id']);
                                $bool = true;
                            }
                        }
                    }
                }
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
