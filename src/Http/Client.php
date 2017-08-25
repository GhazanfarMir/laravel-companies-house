<?php

namespace Ghazanfar\CompaniesHouseApi\Http;

/**
 * Class Client
 * @package Ghazanfar\CompaniesHouseApi\Http
 */
class Client
{

    /**
     * @var string
     */
    protected $api_key = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    /**
     * @var string
     */
    protected $base_uri = 'https://api.companieshouse.gov.uk/';

    /**
     * @var resource
     */
    protected $handle;

    /**
     * @var
     */
    protected $options;

    /**
     * @var
     */
    protected $uri;

    /**
     * Client constructor.
     * @param $base_uri
     * @param $options
     */
    public function __construct($base_uri, $options)
    {
        $this->base_uri = $base_uri;
        $this->options = $options;
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

        $url = sprintf("%s%s?%s", $this->base_uri, $uri, $queryString);

        // initialise curl
        $this->handle = curl_init($url);

        // Optional Authentication:
        curl_setopt($this->handle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($this->handle, CURLOPT_USERPWD, $this->api_key . ":");
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, 1);

        if (false === ($response = curl_exec($this->handle))) {
            echo 'Curl error: ' . curl_error($this->handle);
        }

        curl_close($this->handle);

        return $response;
    }
}