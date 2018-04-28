<?php
namespace Yeelight\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class SocialiteUserValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
		'user_id'	=> 'required',
		'provider'	=> 'required',
		'provider_user_id'	=> 'required',
	],
        ValidatorInterface::RULE_UPDATE => [
        'user_id'	=> 'required',
        'provider'	=> 'required',
        'provider_user_id'	=> 'required',
	],
   ];
}
