<?php

use GhazanfarMir\CompaniesHouse\CompaniesHouse;
use GhazanfarMir\CompaniesHouse\Http\Client;

include 'vendor/autoload.php';

try {

    $base_uri = 'https://api.companieshouse.gov.uk/';

    $api_key = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    $client = new Client($base_uri, $api_key);

    $api = new CompaniesHouse($client);

    $company = 'Ebury Partners';

    // search resources
    $all = $api->search()->all($company);
    print_r('Search all: ' . $all->items[0]->title . PHP_EOL);

    $companies = $api->search()->companies('Ebury Partners');
    print_r('Search Companies: ' . $companies->items[0]->title . PHP_EOL);

    $officers = $api->search()->officers('Mir');
    print_r('Search Officers: ' . $officers->items[0]->title . PHP_EOL);

    $disqualified_officers = $api->search()->disqualified_officers('Mir');
    print_r('Search Disqualified Officers: ' . $disqualified_officers->items[0]->title . PHP_EOL);

    // Companies resources
    $company = $api->company('07086058')->get();
    print_r('Search Company byNumber: ' . $company->company_name . PHP_EOL);

    // Search Officers
    $officers = $api->company('07086058')->officers();
    print_r('Company Officers: ' . $officers->items[0]->name . PHP_EOL);

} catch (Exception $e) {
    echo $e->getMessage();
}