<?php

namespace Ghazanfar\CompaniesHouseApi\Resources;

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
     * Company constructor.
     * @param $client
     */
    public function __construct($client)
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