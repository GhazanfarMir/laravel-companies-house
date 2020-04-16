<?php

namespace GhazanfarMir\CompaniesHouse;

use GhazanfarMir\CompaniesHouse\Http\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CompaniesHouseServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->singleton('companieshouse', function ($app) {
            $base_uri = Config::get('companies.base_uri');

            $api_key = Config::get('companies.key');

            $client = new Client($base_uri, $api_key);

            return new CompaniesHouse($client);
        });
    }

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        /**
         * publish configurations so it can be overridden by package users.
         */
        $config_path = __DIR__.'/../config/companies.php';

        $this->publishes([
            $config_path => config_path('companies.php'),
        ]);
    }
}
