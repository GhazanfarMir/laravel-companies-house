<?php

namespace Ghazanfar\CompaniesHouseApi;

use Ghazanfar\CompaniesHouseApi\Http\Client;
use Ghazanfar\CompaniesHouseApi\Resources\Company;
use Ghazanfar\CompaniesHouseApi\Resources\Documents;
use Ghazanfar\CompaniesHouseApi\Resources\Officers;

/**
 * Class CompaniesHouse.
 */
class CompaniesHouseApi
{
    /**
     * @var
     */
    public $client;

    /**
     * CompaniesHouseApi constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Company
     */
    public function company()
    {
        return new Company($this->client);
    }

    /**
     * @return Officers
     */
    public function officers()
    {
        return new Officers($this->client);
    }

    /**
     * @return Documents
     */
    public function documents()
    {
        return new Documents($this->client);
    }
}
