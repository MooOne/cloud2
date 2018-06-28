<?php

namespace Yeelight\Services\Image\Models\Traits;

use Yeelight\Models\Image\YeelightImage;

/**
 * Trait YeelightHasOneImageTrait
 *
 * @category Yeelight
 *
 * @package Yeelight\Services\Image\Models\Traits
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
trait YeelightHasOneImageTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function yeelight_image()
    {
        return $this->hasOne(YeelightImage::class, 'yeelight_image_id', 'yeelight_image_id');
    }

    /**
     * @return YeelightImage|null
     */
    public function getYeelightImage()
    {
        return $this->yeelight_image;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|null|string
     */
    public function getYeelightImageUrl()
    {
        $yeelightImageType = $this->getYeelightImageType();

        return $this->getYeelightImageUrlForType($yeelightImageType);
    }

    /**
     * @param $type
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|null|string
     */
    public function getYeelightImageUrlForType($type)
    {
        $yeelightImage = $this->getYeelightImage();
        if (!$yeelightImage) {
            return $this->getYeelightImageDefaultUrl();
        }
        if (!empty($type)) {
            return $yeelightImage->getTypeImageUrl($type);
        } else {
            return $yeelightImage->getImageUrl();
        }
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|null|string
     */
    public function getYeelightImageUrlAttribute()
    {
        return $this->getYeelightImageUrl();
    }

    /**
     * @return int|null
     */
    public function getYeelightImageId()
    {
        return $this->yeelight_image_id;
    }

    /**
     * @return null|string
     */
    public function getYeelightImageName()
    {
        $yeelight_image = $this->getYeelightImage();
        if ($yeelight_image) {
            return $yeelight_image->getImageName();
        }
    }

    /**
     * @return null|string
     */
    public function getYeelightImageNameAttribute()
    {
        return $this->getYeelightImageName();
    }

    /**
     * @return null
     */
    protected function getYeelightImageType()
    {
    }

    /**
     * @return null
     */
    protected function getYeelightImageDefaultUrl()
    {
        return backend_asset('img/user2-160x160.jpg');
    }
}
