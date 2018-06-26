<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-18
 * Time: 上午10:54.
 */

namespace Yeelight\Services\Tree;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;

/**
 * Class Tools
 *
 * @category Yeelight
 *
 * @package Yeelight\Services\Tree
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class Tools implements Renderable
{
    /**
     * Parent tree.
     *
     * @var Tree
     */
    protected $tree;

    /**
     * Collection of tools.
     *
     * @var Collection
     */
    protected $tools;

    /**
     * Create a new Tools instance.
     *
     * @param Tree $tree
     *
     * @internal param Builder $builder
     */
    public function __construct(Tree $tree)
    {
        $this->tree = $tree;
        $this->tools = new Collection();
    }

    /**
     * Prepend a tool.
     *
     * @param string $tool
     *
     * @return $this
     */
    public function add($tool)
    {
        $this->tools->push($tool);

        return $this;
    }

    /**
     * Render header tools bar.
     *
     * @return string
     */
    public function render()
    {
        return $this->tools->map(function ($tool) {
            if ($tool instanceof Renderable) {
                return $tool->render();
            }

            if ($tool instanceof Htmlable) {
                return $tool->toHtml();
            }

            return (string) $tool;
        })->implode(' ');
    }
}
