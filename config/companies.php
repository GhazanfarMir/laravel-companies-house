<?php

/*
|--------------------------------------------------------------------------
| Laravel PHP Facade/Wrapper for the CompaniesHouse API
|--------------------------------------------------------------------------
|
| Here is where you can set your key for CompaniesHouse API. In case you do not
| have it, it can be acquired from: https://developer.companieshouse.gov.uk/developer/applications
*/

return [

    /**
     * Endpoint for the CompaniesHouse API
     */

    'base_uri' => 'https://api.companieshouse.gov.uk/',


    /**
     * API Key required to access CompaniesHouse API
     * New API Key can be obtained from the url
     * https://developer.companieshouse.gov.uk/developer/applications
     */

    'key' => env('COMPANIES_HOUSE_API_KEY'),

];