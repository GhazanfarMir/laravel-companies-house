<?php

namespace GhazanfarMir\CompaniesHouse\Http;

use GhazanfarMir\CompaniesHouse\Exceptions\InvalidResourceException;

/**
 * Class Client.
 */
class Client
{
    /**
     * @var string
     */
    protected $api_key;

    /**
     * @var
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
     * @var
     */
    protected $response;

    /**
     * Client constructor.
     *
     * @param $base_uri
     * @param $api_key
     *
     * @internal param $options
     */
    public function __construct($base_uri, $api_key)
    {
        $this->base_uri = $base_uri;

        $this->api_key = $api_key;
    }

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return $this->base_uri;
    }

    /**
     * @param string $base_uri
     */
    public function setBaseUri($base_uri)
    {
        $this->base_uri = $base_uri;
    }

    /**
     * @param $name
     * @param $value
     */
    public function setOption($name, $value)
    {
        curl_setopt($this->handle, $name, $value);
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $options
     *
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        curl_setopt_array($this->handle, $options);

        return $this;
    }

    /**
     * @param $uri
     * @param null $params
     * @return mixed
     * @throws \Exception
     */
    public function get($uri, $params = null)
    {
        $url = $this->buildUrl($uri, $params);

        $this->initialise($url);

        $this->execute();

        $this->close();

        return $this->getResponse();
    }

    /**
     * @param $uri
     * @param $params
     *
     * @return string
     */
    public function buildUrl($uri, $params)
    {
        if (isset($params) && count($params)) {
            $queryString = http_build_query($params);

            return sprintf('%s?%s', $uri, $queryString);
        }

        return sprintf('%s', $uri);
    }

    /**
     * @param $url
     * @throws \Exception
     */
    public function initialise($url)
    {
        if(! function_exists('curl_init')) {
            throw new \Exception('Curl is not currently installed on the machine. You must install Curl to be able to use this package.');
        }

        $this->handle = curl_init($url);

        $this->setOptions([
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->api_key.':',
            CURLOPT_RETURNTRANSFER => 1,
        ]);
    }

    /**
     * @return $this
     * @throws InvalidResourceException
     * @throws \Exception
     */
    public function execute()
    {
        $response = curl_exec($this->handle);

        if (CURLE_OK !== $this->getErrorCode()) {
            throw new \Exception(
                sprintf('An error (%d) occurred while executing the cURL request.', $this->getErrorCode())
            );
        }

        if (200 !== $this->getStatusCode()) {
            throw new InvalidResourceException(
                sprintf('An error with status code (%d) has occurred while executing the cURL request.', $this->getStatusCode())
            );
        }

        $this->response = $response;

        return $this;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return curl_errno($this->handle);
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return curl_error($this->handle);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return json_decode($this->response);
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
    }

    /**
     * @param $option
     * @return mixed
     */
    public function getInfo($option)
    {
        if (empty($option) || $option === '') {
            return curl_getinfo($this->handle);
        }

        return curl_getinfo($this->handle, $option);
    }

    /**
     * close Curl.
     */
    public function close()
    {
        curl_close($this->handle);
    }
}
