<?php
namespace Yeelight\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
		'username'	=> 'required|max:50|unique:users',
		'email'	=> 'nullable|email|unique:users',
		'password'	=> 'required',
	],
        ValidatorInterface::RULE_UPDATE => [
		'username'	=> 'required|max:50|unique:users',
		'email'	=> 'nullable|email|unique:users',
		'password'	=> 'required',
	],
   ];
}
