<?php

namespace Ghazanfar\CompaniesHouse;

use Ghazanfar\CompaniesHouse\Exceptions\ApiBaseUriException;
use Ghazanfar\CompaniesHouse\Exceptions\ApiKeyException;
use GuzzleHttp\Client;


/**
 * Class CompaniesHouse
 * @package Ghazanfar\CompaniesHouse
 */
class CompaniesHouse
{

    /**
     * @var
     */
    public $client;

    /**
     * @var
     */
    protected $base_uri = 'https://api.companieshouse.gov.uk/';

    /**
     * @var
     */
    protected $key;

    /**
     * CompaniesHouse constructor.
     * @param $key
     * @param $base_uri
     * @throws ApiBaseUriException
     * @throws ApiKeyException
     */

    public function __construct($key, $base_uri)
    {


        if (empty($key) || $key == '') {

            throw new ApiKeyException('Missing ApiKey: CompaniesHouse API Key is required. Please visit https://developer.companieshouse.gov.uk/developer/applications');

        }

        if (empty($base_uri) || $base_uri == '') {

            throw new ApiBaseUriException('Missing ApiBaseUri: CompaniesHouse Base Uri is required. Please visit https://developer.companieshouse.gov.uk/developer/applications');

        }


        $this->base_uri = $base_uri;

        $this->key = $key;

        // initialise client

        $this->client = new Client(array(
            'base_uri' => $this->base_uri,
            'auth' => array($key, '')
        ));


    }

    /**
     * @param $company
     * @return \Psr\Http\Message\StreamInterface
     */

    public function search($company)
    {

        if (!empty($company) && $company != '') {

            $params = array(
                'query' => array(
                    'q' => $company
                )
            );

            $response = $this->client->request('GET', 'search/companies', $params);

            return $this->response($response->getBody());

        } else {

            throw new \InvalidArgumentException('Missing Search Term: Company name can not be empty, you must provide a company name to search from Companies House.');
        }

    }

    /**
     * extract data from the response
     *
     * @param $response
     * @return array|mixed|null|object
     * @throws \Exception
     */

    private function response($response)
    {

        if (empty($response) || !is_object($response)) {
            throw new \Exception('Invalid response to extract data from.');
        }

        return json_decode($response);
    }

    /**
     * @param $number
     * @return array|mixed|null|object
     */

    public function searchByNumber($number)
    {

        if (!empty($number) && $number != '') {
            $response = $this->client->request('GET', 'company/' . $number);

            return $this->response($response->getBody());

        } else {

            throw new \InvalidArgumentException('Missing Search Term: Company number can not be empty, you must provide a company number to get profile.');

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