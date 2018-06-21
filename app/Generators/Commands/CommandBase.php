<?php

namespace Yeelight\Generators\Commands;

use Illuminate\Console\Command;

class CommandBase extends Command
{
    public function handle()
    {
        $this->fire();
    }

    public function fire()
    {
        // ...
    }
}
