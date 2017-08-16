<?php


use Ghazanfar\CompaniesHouseApi\CompaniesHouseApi;
use GuzzleHttp\Client;


include 'vendor/autoload.php';

try {

    $base_uri = 'https://api.companieshouse.gov.uk/';

    $api_key = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    $api = new CompaniesHouseApi($api_key, $base_uri);

    //$api = new CompaniesHouse();

    $companies = $api->search('company')->byName('Ebury Partners');
    $company = $api->search('company')->byNumber('07086058');

    echo "<pre>";
    print_r($companies->items[0]);
    echo "</pre>";

    echo "<pre>";
    print_r($company);
    echo "</pre>";

} catch (Exception $e){
    echo $e->getMessage();
}