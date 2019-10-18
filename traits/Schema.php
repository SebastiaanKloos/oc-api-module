<?php namespace Api\Traits;

use Api\Classes\SchemaManager;

trait Schema
{
    public function __construct()
    {
        parent::__construct();

        // Register Schema
        SchemaManager::instance()->register(get_class($this));
    }
}
