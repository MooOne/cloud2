<?php
namespace Yeelight\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Yeelight\Generators\FileAlreadyExistsException;
use Yeelight\Generators\RequestGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RequestCommand extends CommandBase
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'yl:request';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new request.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        try {
            (new RequestGenerator([
                'name' => $this->argument('name'),
                'type' => $this->option('type'),
                'fields' => $this->option('fields'),
                'force' => $this->option('force'),
            ]))->run();
            $this->info("Request created successfully.");
        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type . ' already exists!');

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
                'The name of model for which the transformer is being generated.',
                null
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
                null
            ],
            [
                'type',
                't',
                InputOption::VALUE_REQUIRED,
                'The type attributes, options: web, api.The default value is web',
                'web'
            ],
            [
                'fields',
                null,
                InputOption::VALUE_OPTIONAL,
                'The fields attributes.',
                null
            ],
        ];
    }
}
