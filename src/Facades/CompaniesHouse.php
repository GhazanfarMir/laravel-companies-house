<?php

namespace Ghazanfar\CompaniesHouse\Facades;

use Illuminate\Support\Facades\Facade;

class CompaniesHouse extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */

    protected static function getFacadeAccessor()
    {
        return 'companieshouse';
    }
}