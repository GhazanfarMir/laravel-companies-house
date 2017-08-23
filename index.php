<?php

//error_reporting(0);

use Ghazanfar\CompaniesHouseApi\CompaniesHouseApi;
use GuzzleHttp\Client;

include 'vendor/autoload.php';

try {

    /*$base_uri = 'https://api.companieshouse.gov.uk/';

    $api_key = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    $client = new Client([
        'auth' => [ $api_key, ''],
        'base_uri' => $base_uri
    ]);

    $api = new CompaniesHouseApi($client);

    $all = $api->company()->searchAll('Ebury Partners', 1, 2);

    $companies = $api->company()->search('Ebury Partners');

    $company = $api->company()->find('07086058');

    $officers = $api->officers()->search('Mir');

    // Search all
    print_r('Search All: ' . $all->items[0]->address_snippet . PHP_EOL);

    // Search by name
    print_r('Search Company byName: ' . $companies->items[0]->address_snippet . PHP_EOL);

    // Search by number
    print_r('Search Company byNumber: ' . $company->company_name . PHP_EOL);

    // Search Officers
    print_r('Search Officers: ' . $officers->items[0]->title . PHP_EOL);

    // Search by number
    print_r('Search Company byNumber: ' . $company->company_name . PHP_EOL);

    // Search Officers
    print_r('Search Officers: ' . $officers->items[0]->title . PHP_EOL);

    // Search Disqualified Officers
    print_r('Search Disqualified Officers: ' . $api->officers()->disqualified()->search('Ghazanfar')->items[0]->title . PHP_EOL);*/

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.companieshouse.gov.uk/company/07086058",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Basic SXZTcDZ1RTEzRlBiRThpRFB4NllleTlhUTY0akgzQ3ZtMThlQUVfTjo=",
            "cache-control: no-cache",
            "postman-token: 9d0536ea-759e-1673-2e77-01431235e59f"
        ),
    ));

    $response = curl_exec($curl);

    echo '<pre>';
    print_r($response);
    echo '</pre>';


    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }


} catch (Exception $e) {
    echo $e->getMessage();
}