<?php

namespace Yeelight\Generators\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Yeelight\Generators\ControllerGenerator;
use Yeelight\Generators\FileAlreadyExistsException;

/**
 * Class ControllerCommand
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
class ControllerCommand extends CommandBase
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'yl:controller';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new controller.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Execute the command.
     *
     * @return bool | void
     */
    public function fire()
    {
        try {
            // Generate create request for controller
            $this->call(
                'yl:request',
                [
                    'name' => $this->argument('name') . 'Create',
                    '--type' => 'web',
                    '--fields' => $this->option('fields'),
                    '--force' => $this->option('force'),
                ]
            );
            // Generate update request for controller
            $this->call(
                'yl:request',
                [
                    'name' => $this->argument('name') . 'Update',
                    '--type' => 'web',
                    '--fields' => $this->option('fields'),
                    '--force' => $this->option('force'),
                ]
            );

            (new ControllerGenerator(
                [
                    'name' => $this->argument('name'),
                    'force' => $this->option('force'),
                ]
            ))->run();
            $this->info($this->type.' created successfully.');
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
                'The name of model for which the controller is being generated.',
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
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null,
            ],
            [
                'fields',
                null,
                InputOption::VALUE_OPTIONAL,
                'The fields attributes.',
                null,
            ],
        ];
    }
}
