<?php namespace Cyclepedia\Providers;

use Illuminate\Support\ServiceProvider;

class StringHelperProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'stringhelper',
			'Cyclepedia\Helpers\StringHelper'
		);
	}

}