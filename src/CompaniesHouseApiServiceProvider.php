<?php

namespace Ghazanfar\CompaniesHouseApi;

use Illuminate\Support\ServiceProvider;
use Ghazanfar\CompaniesHouseApi\Http\Client;

class CompaniesHouseApiServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register bindings in the container.
     *
     * @return void
     */

    public function register()
    {

        $this->app->singleton('companieshouse', function ($app) {

            $base_uri = 'https://api.companieshouse.gov.uk/';

            $api_key = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

            $client = new Client($base_uri, $api_key);

            return new CompaniesHouseApi($client);
        });

    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */

    public function boot()
    {

        /**
         * publish configurations so it can be overridden by package users
         */

        $config_path = __DIR__ . '/../config/companies.php';

        $this->publishes([
            $config_path => config_path('companies.php')
        ]);

    }

}