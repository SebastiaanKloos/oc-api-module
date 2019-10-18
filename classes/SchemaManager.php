<?php namespace Api\Classes;

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
}
