<?php namespace Api;

use App;
use Config;
use October\Rain\Support\ModuleServiceProvider;

class ServiceProvider extends ModuleServiceProvider
{
	public function register()
	{
		parent::register('api');

		$this->registerProviders();
		$this->registerConfig();
	}
	
	public function boot() 
	{
		parent::boot('api');

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('api.php'),
            __DIR__.'/assets/schema.graphql' => base_path('graphql/schema.graphql'),
        ]);
	}

	public function registerConfig()
    {
        $config = Config::get('api.lighthouse');
        Config::set('lighthouse', $config);
    }

	public function registerProviders()
    {
        App::register('Nuwave\Lighthouse\LighthouseServiceProvider');
        App::register("MLL\GraphQLPlayground\GraphQLPlaygroundServiceProvider");
    }

	public function registerSingletons()
    {
        App::singleton('api.schema', function () {
            return \Api\Classes\SchemaManager::instance();
        });
    }
}
