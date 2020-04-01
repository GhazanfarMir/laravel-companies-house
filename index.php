<?php

use GhazanfarMir\CompaniesHouse\CompaniesHouse;
use GhazanfarMir\CompaniesHouse\Http\Client;

include 'vendor/autoload.php';

define('NEWLINE', php_sapi_name()==='cli'?PHP_EOL:'<br>');

try {

    $base_uri = 'https://api.companieshouse.gov.uk/';

    $api_key = env('COMPANIES_HOUSE_API_KEY');

    $client = new Client($base_uri, $api_key);

    $api = new CompaniesHouse($client);

    $company = 'Ebury Partners';

    // search resources
    $all = $api->search()->all($company);
    print_r('Search all: ' . $all->items[0]->title . NEWLINE);

    $companies = $api->search()->companies('Ebury Partners');
    print_r('Search Companies: ' . $companies->items[0]->title . NEWLINE);

    $officers = $api->search()->officers('Mir');
    print_r('Search Officers: ' . $officers->items[0]->title . NEWLINE);

    $disqualified_officers = $api->search()->disqualified_officers('Mir');
    print_r('Search Disqualified Officers: ' . $disqualified_officers->items[0]->title . NEWLINE);

    // Companies resources
    $company = $api->company('07086058')->get();
    print_r('Search Company byNumber: ' . $company->company_name . NEWLINE);

    // Search Officers
    $officers = $api->company('07086058')->officers();
    print_r('Company Officers: ' . $officers->items[0]->name . NEWLINE);

} catch (Exception $e) {
    echo $e->getMessage();
}