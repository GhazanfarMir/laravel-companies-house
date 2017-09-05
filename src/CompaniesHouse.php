<?php

namespace GhazanfarMir\CompaniesHouse;

use GhazanfarMir\CompaniesHouse\Http\Client;
use GhazanfarMir\CompaniesHouse\Resources\Search;
use GhazanfarMir\CompaniesHouse\Resources\Company;
use GhazanfarMir\CompaniesHouse\Resources\Officers;
use GhazanfarMir\CompaniesHouse\Resources\Documents;
use GhazanfarMir\CompaniesHouse\Resources\FilingHistory;

/**
 * Class CompaniesHouse.
 */
class CompaniesHouse
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

    /**
     * @return FilingHistory
     */
    public function filingHistory()
    {
        return new FilingHistory($this->client);
    }

    /**
     * @return Search
     */
    public function search()
    {
        return new Search($this->client);
    }
}
