<?php

namespace Yeelight\Generators\Commands;

use Illuminate\Support\Collection;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class EntityCommand
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
class EntityCommand extends CommandBase
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'yl:entity';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new entity.';

    /**
     * $generators
     *
     * @var Collection
     */
    protected $generators = null;

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        $presenter = $this->option('presenter');
        if (is_null($presenter)
            && $this->confirm('Would you like to create a Presenter? [y|N]')
        ) {
            $presenter = 'yes';
        }

        if ($presenter == 'yes') {
            $this->call(
                'yl:presenter',
                [
                    'name' => $this->argument('name'),
                    '--force' => $this->option('force'),
                ]
            );
        }

        $validator = $this->option('validator');
        if (is_null($validator)
            && $this->confirm('Would you like to create a Validator? [y|N]')
        ) {
            $validator = 'yes';
        }

        if ($validator == 'yes') {
            $this->call(
                'yl:validator',
                [
                    'name' => $this->argument('name'),
                    '--rules' => $this->option('rules'),
                    '--force' => $this->option('force'),
                ]
            );
        }

        if ($this->confirm('Would you like to create a Controller? [y|N]')) {

            // Generate a controller resource
            $this->call(
                'yl:controller',
                [
                    'name' => $this->argument('name'),
                    '--fields' => $this->option('fields'),
                    '--force' => $this->option('force'),
                ]
            );
        }

        if ($this->confirm('Would you like to create a API Controller? [y|N]')) {

            // Generate a api controller resource
            $this->call(
                'yl:api_controller',
                [
                    'name' => $this->argument('name'),
                    '--fields' => $this->option('fields'),
                    '--force' => $this->option('force'),
                ]
            );
        }

        if ($this->confirm('Would you like to create CURD views? [y|N]')) {

            // Generate a controller resource
            $this->call(
                'yl:views',
                [
                    'name' => $this->argument('name'),
                    '--fields' => $this->option('fields'),
                    '--force' => $this->option('force'),
                ]
            );
        }

        if ($this->confirm('Would you like to create language package? [y|N]')) {

            // Generate a controller resource
            $this->call(
                'yl:lang',
                [
                    'name' => $this->argument('name'),
                    '--fields' => $this->option('fields'),
                    '--force' => $this->option('force'),
                ]
            );
        }

        $this->call(
            'yl:repository',
            [
                'name' => $this->argument('name'),
                '--fillable' => $this->option('fillable'),
                '--rules' => $this->option('rules'),
                '--fields' => $this->option('fields'),
                '--validator' => $validator,
                '--presenter' => $presenter,
                '--force' => $this->option('force'),
            ]
        );

        $this->call(
            'yl:bindings',
            [
                'name' => $this->argument('name'),
                '--force' => $this->option('force'),
            ]
        );
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
                'The name of class being generated.',
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
                'fillable',
                null,
                InputOption::VALUE_OPTIONAL,
                'The fillable attributes.',
                null,
            ],
            [
                'rules',
                null,
                InputOption::VALUE_OPTIONAL,
                'The rules of validation attributes.',
                null,
            ],
            [
                'validator',
                null,
                InputOption::VALUE_OPTIONAL,
                'Adds validator reference to the repository.',
                null,
            ],
            [
                'presenter',
                null,
                InputOption::VALUE_OPTIONAL,
                'Adds presenter reference to the repository.',
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
