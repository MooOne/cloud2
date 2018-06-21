<?php

namespace Yeelight\Services\Image\Models;

use Yeelight\Base\Models\BaseModel;
use Yeelight\Models\Image\YeelightImage;

/**
 * Yeelight\Services\Image\Models\YeelightImageHash.
 *
 * @property int $yeelight_image_hash_id
 * @property int|null $user_id
 * @property int $yeelight_image_id
 * @property string $file_sha1
 * @property int|null $created_by
 * @property \Carbon\Carbon|null $created_at
 * @property string|null $created_ip
 * @property int|null $updated_by
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $updated_ip
 * @property-read mixed $id
 * @property-read \Yeelight\Models\Image\YeelightImage $image
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageHash whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageHash whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageHash whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageHash whereFileSha1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageHash whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageHash whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageHash whereUpdatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageHash whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageHash whereYeelightImageHashId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageHash whereYeelightImageId($value)
 * @mixin \Eloquent
 */
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
