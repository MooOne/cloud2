<?php

namespace Yeelight\Generators\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Yeelight\Generators\FileAlreadyExistsException;
use Yeelight\Generators\ValidatorGenerator;

/**
 * Class ValidatorCommand
 *
 * @category Yeelight
 *
 * @package Yeelight\Generators\Commands
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class ValidatorCommand extends CommandBase
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'yl:validator';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new validator.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Validator';

    /**
     * Execute the command.
     *
     * @return bool | void
     */
    public function fire()
    {
        try {
            (new ValidatorGenerator(
                [
                    'name' => $this->argument('name'),
                    'rules' => $this->option('rules'),
                    'force' => $this->option('force'),
                ]
            ))->run();
            $this->info('Validator created successfully.');
        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type.' already exists!');

            return false;
        }
    }

    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of model for which the validator is being generated.',
                null,
            ],
        ];
    }

    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            [
                'rules',
                null,
                InputOption::VALUE_OPTIONAL,
                'The rules of validation attributes.',
                null,
            ],
            [
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null,
            ],
        ];
    }
}
