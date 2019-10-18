<?php namespace Api\Classes;

use Cache;
use System\Classes\PluginManager;
use Nuwave\Lighthouse\Schema\Source\SchemaSourceProvider as LighthouseSchemaSourceProvider;
use GraphQL\Language\Parser;
use GraphQL\Error\Error;

class SchemaSourceProvider implements LighthouseSchemaSourceProvider
{
    public $graphMap = [];

    public $graphString = '';

    public function __construct()
    {
        $this->setFileGraph();

        $this->getPluginGraphs();
        $this->prepareSchemaString();
    }

    public function setFileGraph()
    {
        $this->graphString .= file_get_contents(base_path('/graphql/schema.graphql'));
    }

    /**
     * Set schema root path.
     *
     * @param  string  $path
     * @return \Nuwave\Lighthouse\Schema\Source\SchemaSourceProvider
     */
    public function setRootPath(string $path) {
    }

    /**
     * Provide the schema definition.
     *
     * @return string
     */
    public function getSchemaString(): string {
        return $this->graphString;
    }

    public function prepareSchemaString()
    {
        foreach ($this->graphMap as $model) {
            $path = strtolower(str_replace('\\', '/', $model));
            $schema = plugins_path($path . '/schema.graphql');

            $this->graphString .= file_get_contents($schema);
        }
    }

    public function getPluginGraphs()
    {
        $plugins = PluginManager::instance()->getPlugins();

        foreach ($plugins as $plugin) {
            if (method_exists($plugin, 'registerGraphQLModels')) {
                $this->graphMap = array_merge($plugin->registerGraphQLModels(), $this->graphMap);
            }
        }
    }
}
