<?php

namespace Yeelight\Services\Image\Models\Traits;

/**
 * Trait YeelightPivotTrait
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
trait YeelightPivotTrait
{
    /**
     * @return mixed
     */
    public function getPivot()
    {
        return $this->pivot;
    }

    /**
     * @return bool
     */
    public function hasPivot()
    {
        return !empty($this->getPivot());
    }

    /**
     * @return mixed|null
     */
    public function getPivotParent()
    {
        if ($this->hasPivot()) {
            return $this->getPivot()->parent;
        } else {
            return;
        }
    }
}
