<?php
namespace Yeelight\Models;

use Yeelight\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Yeelight\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class AdminMenu extends BaseModel implements Transformable
{
    use TransformableTrait, ModelTree {
        ModelTree::boot as treeBoot;
    }

    /**
     * Indicates if the model should be auto set user_id.
     *
     * @var bool
     */
    protected $autoUserId = false;

    /**
     * Indicates if the model should be recorded ips.
     *
     * @var bool
     */
    protected $ips = false;

    /**
     * Indicates if the model should be recorded users.
     *
     * @var bool
     */
    protected $update_users = false;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'order', 'title', 'icon', 'uri'];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('yeelight.backend.database.admin_menus_table'));

        parent::__construct($attributes);
    }

    /**
     * A Menu belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany
    {
        $pivotTable = config('yeelight.backend.database.admin_role_menus_table');

        $relatedModel = config('yeelight.backend.database.admin_roles_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'menu_id', 'role_id');
    }

    /**
     * @return array
     */
    public function allNodes() : array
    {
        $orderColumn = DB::getQueryGrammar()->wrap($this->orderColumn);
        $byOrder = $orderColumn.' = 0,'.$orderColumn;

        return static::with('roles')->orderByRaw($byOrder)->get()->toArray();
    }

    public function onCreated()
    {
        parent::onCreated();
        $roles = array_filter(request()->get('roles', []));
        if (!empty($roles)) {
            $this->roles()->sync($roles);
        }
    }

    public function onUpdated()
    {
        parent::onUpdated();
        $roles = array_filter(request()->get('roles', []));
        if (!empty($roles)) {
            $this->roles()->sync($roles);
        }
    }

    public function onDeleting()
    {
        parent::onDeleting();
        $this->children()->delete();
        $this->roles()->detach();
    }

    /**
     * Detach models from the relationship.
     *
     * @return void
     */
    protected static function boot()
    {
        static::treeBoot();
    }

}
