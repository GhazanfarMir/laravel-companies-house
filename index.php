<?php

//error_reporting(0);

use Ghazanfar\CompaniesHouseApi\CompaniesHouseApi;
use Ghazanfar\CompaniesHouseApi\Http\Client;

include 'vendor/autoload.php';

try {

    $base_uri = 'https://api.companieshouse.gov.uk/';

    $api_key = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    $client = new Client($base_uri, $api_key);

    $api = new CompaniesHouseApi($client);

    $all = $api->company()->searchAll('Ebury Partners');

    $companies = $api->company()->search('Ebury Partners');

    $company = $api->company()->find('07086058')->get();

    $officers = $api->officers()->search('Mir');

    $disqualified = $api->officers()->disqualified()->search('Mir');

    // Search all
    print_r('Search All: ' . $all->items[0]->address_snippet . PHP_EOL);

    // Search by name
    print_r('Search Company byName: ' . $companies->items[0]->address_snippet . PHP_EOL);

    // Search by number
    print_r('Search Company byNumber: ' . $company->company_name . PHP_EOL);

    // Search Officers
    print_r('Search Officers: ' . $officers->items[0]->title . PHP_EOL);

    // Search Disqualified Officers
    print_r('Search Disqualified Officers: ' . $disqualified->items[0]->title . PHP_EOL);

} catch (Exception $e) {
    echo $e->getMessage();
}