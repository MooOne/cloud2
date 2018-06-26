<?php

namespace Yeelight\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @category Yeelight
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class UserValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
   ];
}
