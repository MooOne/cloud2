<?php

namespace Yeelight\Transformers;

use Yeelight\Base\Transformers\Transformer;

/**
 * Class BasicTransformer
 *
 * @category Yeelight
 *
 * @package Yeelight\Transformers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class BasicTransformer extends Transformer
{
    /**
     * Transform the Any entity.
     *
     * @param $value
     *
     * @return mixed
     */
    public function transform($value)
    {
        return $value;
    }
}
