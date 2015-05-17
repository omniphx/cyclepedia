<?php namespace Cyclepedia\Providers;

use Illuminate\Support\ServiceProvider;

class CsvHandlerProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(
            'csvhandler',
            'Cyclepedia\Handlers\CsvHandler'
        );
    }

}