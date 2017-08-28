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
    protected $api_key;

    /**
     * @var string
     */
    protected $base_uri;

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
     * @param $api_key
     * @internal param $options
     */
    public function __construct($base_uri, $api_key)
    {
        $this->base_uri = $base_uri;

        $this->api_key = $api_key;
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

        try {
            // initialise curl
            $this->handle = curl_init($url);

            // Optional Authentication:
            curl_setopt($this->handle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($this->handle, CURLOPT_USERPWD, $this->api_key . ":");
            curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($this->handle);

            if (false === $response) {
                echo 'Curl error: ' . curl_error($this->handle);
            }

            curl_close($this->handle);

            return $response;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}