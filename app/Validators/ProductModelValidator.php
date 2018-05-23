<?php
namespace Yeelight\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProductModelValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
		'title'	=>'	required',
		'model_name'	=>'	required|max:150',
		'code'	=>'	required|max:50',
	],
        ValidatorInterface::RULE_UPDATE => [
		'title'	=>'	required',
		'model_name'	=>'	required|max:150',
		'code'	=>'	required|max:50',
	],
   ];
}
