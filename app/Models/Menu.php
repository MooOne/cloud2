<?php
namespace Yeelight\Models;

use Yeelight\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Menu extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $primaryKey = 'menu_id';

    protected $fillable = ['pid','name','icon','slug','url','active','description','sort'];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

    public function setSortAttribute($value)
    {
        if ($value && is_numeric($value)) {
            $this->attributes['sort'] = intval($value);
        }else{
            $this->attributes['sort'] = 0;
        }
    }
}
