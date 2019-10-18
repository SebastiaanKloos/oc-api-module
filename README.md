# oc-api-module
API module for OctoberCMS

## Installation
- Copy module to **{project root}/modules/api**
- Run command `composer update` in project root
- Add `api` to `cms.loadModules` configuration
- Run command `php artisan vendor:publish --provider="Api\ServiceProvider"` in project root

## File base schema
You can use the schema located at **{project root}/graphql/schema.graphql**.

## Registering models to GraphQL
* Add the following function to your **Plugin.php** file.
```php
public function registerGraphQLModels()
{
    return [
        'RainLab\User\Models\User',
    ];
} 
```
* Create **/plugins/user/models/user/schema.graphql**

> Schemas created for a model inside of a plugin should always use `extend type Query` to define a query.

## Test your schemas
The modules comes with the GraphQL playground. Go to **/graphql-playground** in your browser and test your schema here. 
