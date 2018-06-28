<?php

namespace Yeelight\Services\Image\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Yeelight\Models\Image\YeelightImage;

/**
 * Trait YeelightHasImageablesTrait
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
trait YeelightHasImageablesTrait
{
    /**
     * @return mixed|MorphToMany
     */
    public function images()
    {
        return $this->morphToMany(YeelightImage::class, 'imageable', 'yeelight_imageables', null, 'yeelight_image_id')
            ->withPivot('sequence', 'is_main', 'type', 'data')
            ->orderBy('sequence', 'asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function main_images()
    {
        return $this->images()->wherePivot('is_main', '=', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function type_images($type)
    {
        return $this->images()->wherePivot('type', '=', $type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function type_main_images($type)
    {
        return $this->main_images()->wherePivot('type', '=', $type);
    }

    /**
     * @param $yeelight_image_ids
     * @param array $data
     */
    public function syncImages($yeelight_image_ids, $data = [])
    {
        $this->images()->detach();
        foreach ($yeelight_image_ids as $sequence => $yeelight_image_id) {
            $this->images()->attach($yeelight_image_id, array_merge([
                'sequence' => $sequence,
            ], $data));
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return YeelightImage|null
     */
    public function getMainImage()
    {
        return $this->main_images()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMainImages()
    {
        return $this->main_images()->get();
    }

    /**
     * @param $type
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTypeImages($type)
    {
        return $this->type_images($type)->get();
    }

    /**
     * @param $type
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTypeMainImages($type)
    {
        return $this->type_main_images($type)->get();
    }

    /**
     * @param YeelightImage $yeelightImage
     *
     * @return int
     */
    public function setAsMainImage(YeelightImage $yeelightImage)
    {
        $this->images()->rawUpdate(['is_main' => false]);

        return $this->images()->updateExistingPivot($yeelightImage->getKey(), ['is_main' => true]);
    }

    /**
     * @param string        $type
     * @param YeelightImage $yeelightImage
     *
     * @return int
     */
    public function setAsTypeMainImage($type, YeelightImage $yeelightImage)
    {
        $this->type_images($type)->rawUpdate(['is_main' => false]);

        return $this->type_images($type)->updateExistingPivot($yeelightImage->getKey(), ['is_main' => true]);
    }

    /**
     * @param bool $withYeelightImageId
     *
     * @return \Illuminate\Support\Collection
     */
    public function getImageUrls($withYeelightImageId = false)
    {
        return $this->getNamedImageUrls('image_url', $withYeelightImageId);
    }

    /**
     * @param $imageUrlAttributeName
     * @param bool $withYeelightImageId
     *
     * @return \Illuminate\Support\Collection
     */
    public function getNamedImageUrls($imageUrlAttributeName, $withYeelightImageId = false)
    {
        $key = $withYeelightImageId ? 'yeelight_image_id' : null;

        return $this->getImages()->pluck($imageUrlAttributeName, $key);
    }

    /**
     * @param $type
     * @param $imageUrlAttributeName
     * @param bool $withYeelightImageId
     *
     * @return \Illuminate\Support\Collection
     */
    public function getTypeNamedImageUrls($type, $imageUrlAttributeName, $withYeelightImageId = false)
    {
        $key = $withYeelightImageId ? 'yeelight_image_id' : null;

        return $this->getTypeImages($type)->pluck($imageUrlAttributeName, $key);
    }
}
