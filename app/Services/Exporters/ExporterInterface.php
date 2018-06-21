<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-10
 * Time: 上午11:32.
 */

namespace Yeelight\Services\Exporters;

interface ExporterInterface
{
    /**
     * Export data from Repository.
     *
     * @return mixed
     */
    public function export();
}
