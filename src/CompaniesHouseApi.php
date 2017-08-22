<?php

namespace Ghazanfar\CompaniesHouseApi;

use Ghazanfar\CompaniesHouseApi\Resources\Documents;
use Ghazanfar\CompaniesHouseApi\Resources\Officers;
use Ghazanfar\CompaniesHouseApi\Resources\Company;
use GuzzleHttp\Client;


/**
 * Class CompaniesHouse
 * @package Ghazanfar\CompaniesHouse
 */
class CompaniesHouseApi
{

    /**
     * @var
     */
    public $client;

    /**
     * @var
     */
    protected $base_uri = 'https://api.companieshouse.gov.uk/';

    /**
     * @var
     */
    protected $key;

    /**
     * CompaniesHouseApi constructor.
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
     * @param $resource
     * @return Company
     * @throws InvalidResourceException
     */

    /*public function search($resource)
    {

        switch ($resource) {

            case 'company':
                return new Company($this->client);
                break;

            case 'officers':
                return new Officers($this->client);
                break;

            case 'documents':
                return new Documents($this->client);
                break;

            default:
                throw new InvalidResourceException('Invalid resource. You must provide only valid resource type.');
        }

    }*/
}