<?php

namespace Yeelight\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class ProductModelValidator
 *
 * @category Yeelight
 *
 * @package Yeelight\Validators
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class ProductModelValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        'title'	     => '	required',
        'model_name'	=> '	required|max:150',
        'code'	      => '	required|max:50',
    ],
        ValidatorInterface::RULE_UPDATE => [
        'title'	     => '	required',
        'model_name'	=> '	required|max:150',
        'code'	      => '	required|max:50',
    ],
   ];
}
