<?php

namespace Ghazanfar\CompaniesHouseApi\Http;

/**
 * Class Client
 * @package Ghazanfar\CompaniesHouseApi\Http
 */
class Client
{

    /**
     * API KEY used for testing
     */

    const API_KEY = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    /**
     * BASE API
     */
    const BASE_URI = 'https://api.companieshouse.gov.uk/';

    /**
     * @var resource
     */
    protected $curl;

    /**
     * Client constructor.
     */
    public function __construct()
    {

        // initialise curl
        $this->curl = curl_init();

        // Optional Authentication:
        curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($this->curl, CURLOPT_USERPWD, self::API_KEY . ":");

    }

    /**
     * @param $uri
     * @param null $params
     * @return array|mixed|null|object
     */
    public function get($uri, $params = null)
    {

        $queryString = '';

        if (isset($params)) {
            $queryString = http_build_query($params);
        }

        $url = sprintf("%s%s?%s", self::BASE_URI, $uri, $queryString);

        curl_setopt($this->curl, CURLOPT_URL, $url);

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($this->curl);

        echo "<pre>";
        print_r($response);
        echo "</pre>";

        return $response;
    }
}