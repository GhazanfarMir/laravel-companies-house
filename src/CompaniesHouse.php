<?php

namespace Ghazanfar\CompaniesHouse;

use Exception;
use Ghazanfar\CompaniesHouse\Exceptions\ApiKeyException;
use GuzzleHttp\Client;

class CompaniesHouse
{

    /**
     * @var
     */
    public $client;
    /**
     * @var
     */
    protected $base_api = 'https://api.companieshouse.gov.uk/';
    /**
     * @var
     */
    protected $key;

    /**
     * CompaniesHouse constructor.
     * @param $key
     * @throws ApiKeyException
     */

    public function __construct($key)
    {

        if (!empty($key) && $key != '') {
            $this->key = $key;

            $this->client = new Client(array(
                'base_uri' => $this->base_api,
                'auth' => array(
                    $key,
                    ''
                )
            ));

        } else {

            throw new ApiKeyException('CompaniesHouse API Key is required. Please visit https://developer.companieshouse.gov.uk/developer/applications');

        }

    }

    /**
     * @param $company
     * @return \Psr\Http\Message\StreamInterface
     */

    public function search($company)
    {

        $params = array(
            'query' => array(
                'q' => $company
            )
        );
        
        $response = $this->client->request('GET', 'search/companies', $params);

        return $response;
    }

    /**
     * @param $number
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws Exception
     */

    public function searchByNumber($number)
    {

        if (!empty($number) && $number != '') {
            $response = $this->client->request('GET', 'company/' . $number);

            return $response;

        } else {

            throw new Exception('Company number can not be empty. You must provide a company number to get profile');

        }
    }

    /**
     * test method
     */

    public function test()
    {
        var_dump('This is the test message');
    }
}