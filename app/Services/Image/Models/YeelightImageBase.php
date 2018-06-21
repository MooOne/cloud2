<?php

namespace Yeelight\Services\Image\Models;

use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\PresentableTrait;
use Yeelight\Base\Models\BaseModel;
use Yeelight\Services\Image\Models\Traits\YeelightPivotTrait;

/**
 * Yeelight\Services\Image\Models\YeelightImageBase.
 *
 * @property int $yeelight_image_id
 * @property int|null $user_id
 * @property string $image_name
 * @property string|null $exif
 * @property int $is_gif
 * @property int $file_size
 * @property int $width
 * @property int $height
 * @property int|null $created_by
 * @property \Carbon\Carbon|null $created_at
 * @property string|null $created_ip
 * @property int|null $updated_by
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $updated_ip
 * @property-read mixed $id
 * @property-read null|string $image_url
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereExif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereImageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereIsGif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereUpdatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Services\Image\Models\YeelightImageBase whereYeelightImageId($value)
 * @mixin \Eloquent
 */
class YeelightImageBase extends BaseModel implements Transformable, Presentable
{
    use YeelightPivotTrait;
    use PresentableTrait;

    const MORPH_NAME = 'YeelightImage';

    protected $table = 'yeelight_images';

    protected $primaryKey = 'yeelight_image_id';

    protected $fillable = [
        'user_id', 'image_name', 'exif', 'is_gif', 'file_size', 'width', 'height',
    ];

    protected $hidden = [
        'created_at', 'created_by', 'created_ip',
        'updated_at', 'updated_by', 'updated_ip',
    ];

    /**
     * @return int
     */
    public function getYeelightImageId()
    {
        return $this->yeelight_image_id;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->image_name;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->file_size > 0;
    }

    /**
     * @return null|string
     */
    public function getImageUrl()
    {
        return $this->getTypeImageUrl();
    }

    /**
     * @return null|string
     */
    public function getImageUrlAttribute()
    {
        return $this->getImageUrl();
    }

    /**
     * @param $type
     *
     * @return null|string
     */
    public function getTypeImageUrl($type = null)
    {
        $type = $type ? $type.'/' : null;

        if ($this->isValid()) {
            return url('/image/'.$type.$this->getImageName());
        } else {
            return $this->getDefaultImageUrl($type = null);
        }
    }

    /**
     * @param null $type
     *
     * @return null|string
     */
    public function getDefaultImageUrl($type = null)
    {
    }

    /**
     * @return string
     */
    public function getImagePath()
    {
        $storage_path = config('yeelight-image.storage_path');

        return $storage_path.$this->getImageName();
    }

    /**
     * @return array
     */
    public function transform()
    {
        return [
            'yeelight_image_id' => $this->getYeelightImageId(),
            'image_name'        => $this->getImageName(),
        ];
    }

    /**
     * @return array
     */
    public function toSimpleArray()
    {
        $yeelightImage = $this;

        return [
            'yeelight_image_id'   => $yeelightImage->getYeelightImageId(),
            'yeelight_image_url'  => $yeelightImage->getImageUrl(),
            'thumbnail_image_url' => $yeelightImage->getTypeImageUrl('thumbnail'),
        ];
    }
}
