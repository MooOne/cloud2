<?php

namespace Yeelight\Models\Interfaces;

/**
 * Interface BaseModelEventsInterface
 *
 * @category Yeelight
 *
 * @package Yeelight\Models\Interfaces
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
interface BaseModelEventsInterface
{
    public function onCreating();

    public function onCreated();

    public function onUpdating();

    public function onUpdated();

    public function onSaving();

    public function onSaved();

    public function onDeleting();

    public function onDeleted();

    public function onRestoring();

    public function onRestored();
}
