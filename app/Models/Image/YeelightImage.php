<?php
namespace Yeelight\Models\Image;

use Yeelight\Services\Image\Models\YeelightImageBase;

class YeelightImage extends YeelightImageBase
{

    /**
     * @param null $type
     * @return null|string
     */
    public function getDefaultImageUrl($type = null)
    {
//        return url('images/default.jpg');
        return null;
    }

    /**
     * For usage: $yeelightImage->cover_image_url;
     *
     * @return null|string
     */
    public function getCoverImageUrlAttribute()
    {
        return $this->getTypeImageUrl('cover');
    }

}