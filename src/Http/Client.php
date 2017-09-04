<?php

namespace Ghazanfar\CompaniesHouseApi\Http;

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
     *
     * @return array|mixed|null|object
     */
    public function get($uri, $params = null)
    {
        try {
            $url = $this->buildUrl($uri, $params);

            $this->initialise($url);

            $this->execute();

            $this->close();

            return $this->getResponse();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
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

            return sprintf('%s%s?%s', $this->base_uri, $uri, $queryString);
        }

        return sprintf('%s%s', $this->base_uri, $uri);
    }

    /**
     * @param $url
     */
    public function initialise($url)
    {
        $this->handle = curl_init($url);

        $this->setOptions([
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->api_key.':',
            CURLOPT_RETURNTRANSFER => 1,
        ]);
    }

    /**
     * @return mixed
     *
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
     * @return mixed
     */
    public function getResponse()
    {
        return json_decode($this->response);
    }

    /**
     * close Curl.
     */
    public function close()
    {
        curl_close($this->handle);
    }
}
