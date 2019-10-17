<?php namespace Api;

use App;
use October\Rain\Support\ModuleServiceProvider;

class ServiceProvider extends ModuleServiceProvider
{
	public function register()
	{
		parent::register('api');
	}
	
	public function boot() 
	{
		parent::boot('api');
	}
}