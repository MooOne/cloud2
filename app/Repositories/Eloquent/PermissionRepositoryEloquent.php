<?php
namespace Yeelight\Repositories\Eloquent;

use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\PermissionRepository;
use Yeelight\Models\Permission;
use Yeelight\Validators\PermissionValidator;
use Yeelight\Presenters\PermissionPresenter;

/**
 * Class PermissionRepositoryEloquent
 * @package namespace Yeelight\Repositories\Eloquent;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PermissionValidator::class;
    }


    /**
    * Specify Presenter class name
    *
    * @return mixed
    */
    public function presenter()
    {

        return PermissionPresenter::class;
    }

    /**
     * datatables获取数据
     *
     * @return array
     */
    public function ajaxIndex()
    {
        // datatables请求次数
        $draw = request('draw', 1);
        // 开始条数
        $start = request('start', config('yeelight.console.pagination.start'));
        // 每页显示数目
        $length = request('length', config('yeelight.console.pagination.length'));
        // datatables是否启用模糊搜索
        $search['regex'] = request('search.regex', false);
        // 搜索框中的值
        $search['value'] = request('search.value', '');
        // 排序
        $order['name'] = request('columns.' .request('order.0.column',0) . '.name');
        $order['dir'] = request('order.0.dir','asc');

        $result = $this->getPermissionList($start,$length,$search,$order);

        $permissions = [];

        if ($result['permissions']) {
            foreach ($result['permissions'] as $v) {
                $v->actionButton = $v->getActionButtonAttribute();
                $permissions[] = $v;
            }
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $result['count'],
            'recordsFiltered' => $result['count'],
            'data' => $permissions,
        ];
    }

    /**
     * 查询权限并分页
     * @author Sheldon
     * @date   2016-11-02T15:17:24+0800
     * @param  [type]                   $start  [起始数目]
     * @param  [type]                   $length [读取条数]
     * @param  [type]                   $search [搜索数组数据]
     * @param  [type]                   $order  [排序数组数据]
     * @return [type]                           [查询结果集，包含查询的数量及查询的结果对象]
     */
    public function getPermissionList($start, $length, $search, $order)
    {
        $permission = $this->model;
        if ($search['value']) {
            if($search['regex'] == 'true'){
                $permission = $permission->where('name', 'like', "%{$search['value']}%")->orWhere('slug','like', "%{$search['value']}%");
            }else{
                $permission = $permission->where('name', $search['value'])->orWhere('slug', $search['value']);
            }
        }

        $count = $permission->count();

        $permission = $permission->orderBy($order['name'], $order['dir']);

        $permissions = $permission->offset($start)->limit($length)->get();

        return compact('count','permissions');
    }

    /**
     * 获取所有的权限并按照功能分组
     * @author Sheldon
     * @date   2016-11-03T13:20:18+0800
     * @return [type]                   [description]
     */
    public function groupPermissionList()
    {
        $permissions = $this->model->all();
        $array = [];
        if ($permissions) {
            foreach ($permissions as $v) {
                array_set($array, $v->slug, ['id' => $v->id,'name' => $v->name]);
            }
        }
        return $array;
    }

    /**
     * 获取所有的权限
     * @author Sheldon
     * @date   2017-04-19T13:20:18+0800
     * @return [type]                   [description]
     */
    public function allPermissions()
    {
        return $this->model->all();
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
