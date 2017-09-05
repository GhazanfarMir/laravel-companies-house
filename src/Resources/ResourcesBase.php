<?php

namespace GhazanfarMir\CompaniesHouse\Resources;

use GhazanfarMir\CompaniesHouse\Http\Client;

/**
 * Class ResourcesBase.
 */
class ResourcesBase
{
    /**
     * @var
     */
    protected $client;

    /**
     * @var string
     */
    protected $base_uri = 'https://api.companieshouse.gov.uk';

    /**
     * ResourcesBase constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $response
     *
     * @return array|mixed|null|object
     *
     * @throws \Exception
     */
    protected function response($response)
    {
        if (empty($response)) {
            throw new \Exception('Invalid response to extract data from.');
        }

        return json_decode($response);
    }

    /**
     * @param $uri
     * @return string
     */
    protected function buildResourceUrl($uri)
    {
        return $this->base_uri.$uri;
    }
}
