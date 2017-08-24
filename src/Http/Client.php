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

        // initialise curl
        $this->curl = curl_init($url);

        // Optional Authentication:
        curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($this->curl, CURLOPT_USERPWD, self::API_KEY . ":");
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);

        if (false === ($response = curl_exec($this->curl))) {
            echo 'Curl error: ' . curl_error($this->curl);
        }

        curl_close($this->curl);

        return $response;
    }
}