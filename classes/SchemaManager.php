<?php namespace Api\Classes;

use Config;
use System\Classes\PluginManager;

class SchemaManager
{
    use \October\Rain\Support\Traits\Singleton;

    protected $schemas = [];

    /**
     * Registers a new schema
     *
     * @param string $modelClass
     */
    public function register($modelClass)
    {
        if (in_array($modelClass, $this->schemas)) {
            return;
        }

        array_push($this->schemas, $modelClass);
    }

    /**
     * Returns all the schemas registered
     *
     * @return array
     */
    public function getAll()
    {
        return $this->schemas;
    }

    public function registerModelNamespaces()
    {
        $namespaces = config('lighthouse.namespaces.models');

        foreach (PluginManager::instance()->getPlugins() as $key => $plugin) {
            if (method_exists($plugin, 'registerGraphQLModels')) {
                $namespace = str_replace('.', '\\', $key) . '\\Models';

                array_push($namespaces, $namespace);
            }
        }

        Config::set('lighthouse.namespaces.models', $namespaces);
    }
}
