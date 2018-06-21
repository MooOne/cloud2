<?php

namespace Yeelight\Services\Image\Models\Traits;

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
