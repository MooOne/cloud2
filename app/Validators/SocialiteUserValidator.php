<?php

namespace Yeelight\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class SocialiteUserValidator
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
class SocialiteUserValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        'user_id'	         => 'required',
        'provider'	        => 'required',
        'provider_user_id'	=> 'required',
    ],
        ValidatorInterface::RULE_UPDATE => [
        'user_id'	         => 'required',
        'provider'	        => 'required',
        'provider_user_id'	=> 'required',
    ],
   ];
}
