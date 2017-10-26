<?php
namespace Yeelight\Services\Image\Models;

use Yeelight\Base\Models\BaseModel;
use Yeelight\Models\Image\YeelightImage;

class YeelightImageHash extends BaseModel
{

    protected $table = 'yeelight_image_hashes';

    protected $primaryKey = 'yeelight_image_hash_id';

    protected $fillable = ['yeelight_image_id', 'file_sha1'];

    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(YeelightImage::class, 'yeelight_image_id', 'yeelight_image_id');
    }

}
