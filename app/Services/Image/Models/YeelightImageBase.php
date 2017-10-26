<?php
namespace Yeelight\Services\Image\Models;

use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\PresentableTrait;
use Yeelight\Base\Models\BaseModel;
use Yeelight\Services\Image\Models\Traits\YeelightPivotTrait;

class YeelightImageBase extends BaseModel implements Transformable, Presentable
{
    use YeelightPivotTrait;
    use PresentableTrait;

    const MORPH_NAME = 'YeelightImage';

    protected $table = 'yeelight_images';

    protected $primaryKey = 'yeelight_image_id';

    protected $fillable = [
        'user_id', 'image_name', 'exif', 'is_gif', 'file_size', 'width', 'height'
    ];

    protected $hidden = [
        'created_at', 'created_by', 'created_ip',
        'updated_at', 'updated_by', 'updated_ip',
    ];

    /**
     * @return Int
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
     * @return null|string
     */
    public function getTypeImageUrl($type = null)
    {
        $type = $type ? $type . '/' : null;

        if ($this->isValid()) {
            return url('/image/' . $type . $this->getImageName());
        } else {
            return $this->getDefaultImageUrl($type = null);
        }
    }

    /**
     * @param null $type
     * @return null|string
     */
    public function getDefaultImageUrl($type = null)
    {
        return null;
    }

    /**
     * @return string
     */
    public function getImagePath()
    {
        $storage_path = config("yeelight-image.storage_path");
        return $storage_path . $this->getImageName();
    }

    /**
     * @return array
     */
    public function transform()
    {
        return [
            'yeelight_image_id' => $this->getYeelightImageId(),
            'image_name' => $this->getImageName(),
        ];
    }

    /**
     * @return array
     */
    public function toSimpleArray()
    {
        $yeelightImage = $this;
        return [
            'yeelight_image_id' => $yeelightImage->getYeelightImageId(),
            'yeelight_image_url' => $yeelightImage->getImageUrl(),
            'thumbnail_image_url' => $yeelightImage->getTypeImageUrl('thumbnail'),
        ];
    }

}
