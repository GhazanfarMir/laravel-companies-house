<?php

//error_reporting(0);

use GhazanfarMir\CompaniesHouse\CompaniesHouseApi;
use GhazanfarMir\CompaniesHouse\Http\Client;

include 'vendor/autoload.php';

try {

    $base_uri = 'https://api.companieshouse.gov.uk/';

    $api_key = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    $client = new Client($base_uri, $api_key);

    $api = new CompaniesHouseApi($client);

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

    /* // Search all
     $all = $api->company()->searchAll('Ebury Partners');
     print_r('Search All: ' . $all->items[0]->address_snippet . PHP_EOL);

     // Search by name
     $companies = $api->company()->search('Ebury Partners');
     print_r('Search Company byName: ' . $companies->items[0]->address_snippet . PHP_EOL);

     // Search by number
     $company = $api->company()->find('07086058')->get();
     print_r('Search Company byNumber: ' . $company->company_name . PHP_EOL);

     // Search Officers
     $officers = $api->officers()->search('Mir');
     print_r('Search Officers: ' . $officers->items[0]->title . PHP_EOL);

     // Search Disqualified Officers
     $disqualified = $api->officers()->disqualified()->search('Mir');
     print_r('Search Disqualified Officers: ' . $disqualified->items[0]->title . PHP_EOL);

     // company officers
     print_r('Show Company officers: ' . $api->company()->with(['officers'])->find('07086058')->officers()->items[0]->name . PHP_EOL);

     // registered address
     $o = $api->company()->with(array('officers', 'charges', 'registered_office_address', 'filing_history'))->find('07086058');
     print_r('Company registered address: ' . $o->registeredOfficeAddress()->address_line_1. PHP_EOL);

     // filing history
     print_r('Show Company Filing history: '.$o->filingHistory()->items[0]->description . PHP_EOL);*/

} catch (Exception $e) {
    echo $e->getMessage();
}