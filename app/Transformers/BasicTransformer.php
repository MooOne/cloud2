<?php
namespace Yeelight\Transformers;

use Yeelight\Base\Transformers\Transformer;

class BasicTransformer extends Transformer
{

    /**
     * Transform the Any entity
     *
     * @param $value
     * @return mixed
     */
    public function transform($value)
    {
        return $value;
    }
    
}