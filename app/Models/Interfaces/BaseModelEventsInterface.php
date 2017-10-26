<?php
namespace Yeelight\Models\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Yeelight\Models\Observers\BaseModelObserver;

interface BaseModelEventsInterface
{

    function onCreating();
    function onCreated();

    function onUpdating();
    function onUpdated();

    function onSaving();
    function onSaved();

    function onDeleting();
    function onDeleted();

    function onRestoring();
    function onRestored();

}