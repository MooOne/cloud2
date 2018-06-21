<?php

namespace Yeelight\Models\Interfaces;

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
