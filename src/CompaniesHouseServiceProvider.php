<?php

namespace Ghazanfar\CompaniesHouse;

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
     *
     * @return void
     */

    public function register()
    {

        $this->app->singleton('companieshouse', function ($app) {
            return new CompaniesHouse(config('companies.key'), config('companies.base_uri'));
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