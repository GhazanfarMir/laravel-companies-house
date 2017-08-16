<?php

namespace Ghazanfar\CompaniesHouseApi\Facades;

use Illuminate\Support\Facades\Facade;

class CompaniesHouseApi extends Facade
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