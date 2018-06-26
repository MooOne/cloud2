<?php

namespace Yeelight\Generators\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Yeelight\Generators\FileAlreadyExistsException;
use Yeelight\Generators\LangGenerator;

/**
 * Class LangCommand
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
class LangCommand extends CommandBase
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'yl:lang';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create new language package.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Lang';

    /**
     * Execute the command.
     *
     * @return bool | void
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function fire()
    {
        try {
            (new LangGenerator(
                [
                    'name' => $this->argument('name'),
                    'fields' => $this->option('fields'),
                    'force' => $this->option('force'),
                ]
            ))->run();
            $this->info('Language package created successfully.');
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
                'The name of model for which the language package is being generated.',
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
