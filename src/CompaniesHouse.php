<?php

namespace GhazanfarMir\CompaniesHouse;

use GhazanfarMir\CompaniesHouse\Http\Client;
use GhazanfarMir\CompaniesHouse\Resources\Search;
use GhazanfarMir\CompaniesHouse\Resources\Charges;
use GhazanfarMir\CompaniesHouse\Resources\Company;
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
     * @return Search
     */
    public function search()
    {
        return new Search($this->client);
    }

    /**
     * @param $number
     * @return FilingHistory
     */
    public function filingHistory($number)
    {
        return new FilingHistory($this->client, $number);
    }

    /**
     * @param $number
     * @return Charges
     */
    public function charges($number)
    {
        return new Charges($this->client, $number);
    }
}
