<?php

namespace Yeelight\Models\Image;

use Yeelight\Services\Image\Models\YeelightImageBase;

/**
 * Yeelight\Models\Image\YeelightImage.
 *
 * @category Yeelight
 *
 * @package Yeelight\Models\Image
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
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
 * @property-read null|string $cover_image_url
 * @property-read mixed $id
 * @property-read null|string $image_url
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereExif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereImageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereIsGif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereUpdatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Image\YeelightImage whereYeelightImageId($value)
 * @mixin \Eloquent
 */
class YeelightImage extends YeelightImageBase
{
    /**
     * GetDefaultImageUrl
     *
     * @param string | null $type type
     *
     * @return null|string
     */
    public function getDefaultImageUrl($type = null)
    {
//        return url('images/default.jpg');
    }

    /**
     * For usage: $yeelightImage->cover_image_url;.
     *
     * @return null|string
     */
    public function getCoverImageUrlAttribute()
    {
        return $this->getTypeImageUrl('cover');
    }
}
