<?php

namespace Yeelight\Generators\Commands;

use Illuminate\Console\Command;

/**
 * Class CommandBase
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
