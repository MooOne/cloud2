<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-10
 * Time: 上午11:32.
 */

namespace Yeelight\Services\Exporters;

/**
 * Interface ExporterInterface
 *
 * @category Yeelight
 *
 * @package Yeelight\Services\Exporters
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
interface ExporterInterface
{
    /**
     * Export data from Repository.
     *
     * @return mixed
     */
    public function export();
}
