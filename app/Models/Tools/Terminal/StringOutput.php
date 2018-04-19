<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-19
 * Time: 下午2:23
 */
namespace Yeelight\Models\Tools\Terminal;

use Symfony\Component\Console\Output\Output;

class StringOutput extends Output
{
    public $output = '';
    public function clear()
    {
        $this->output = '';
    }
    protected function doWrite($message, $newline)
    {
        $this->output .= $message.($newline ? "\n" : '');
    }
    public function getContent()
    {
        return trim($this->output);
    }
}