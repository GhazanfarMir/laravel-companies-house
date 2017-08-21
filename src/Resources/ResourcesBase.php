<?php

namespace Ghazanfar\CompaniesHouseApi\Resources;

use GuzzleHttp\Client;

/**
 * Class ResourcesBase
 * @package Ghazanfar\CompaniesHouse\Resources
 */

class ResourcesBase
{

    /**
     * @var
     */
    protected $client;

    /**
     * ResourcesBase constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {

        $this->client = $client;

    }

    /**
     * @param $response
     * @return array|mixed|null|object
     * @throws \Exception
     */
    protected function response($response)
    {

        if (empty($response) || !is_object($response)) {
            throw new \Exception('Invalid response to extract data from.');
        }

        return json_decode($response);
    }


}