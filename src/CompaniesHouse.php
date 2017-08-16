<?php

namespace Ghazanfar\CompaniesHouse;

use Ghazanfar\CompaniesHouse\Exceptions\InvalidResourceException;
use Ghazanfar\CompaniesHouse\Exceptions\ApiBaseUriException;
use Ghazanfar\CompaniesHouse\Exceptions\ApiKeyException;
use Ghazanfar\CompaniesHouse\Resources\Documents;
use Ghazanfar\CompaniesHouse\Resources\Officers;
use Ghazanfar\CompaniesHouse\Resources\Company;
use GuzzleHttp\Client;


/**
 * Class CompaniesHouse
 * @package Ghazanfar\CompaniesHouse
 */
class CompaniesHouse
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
     * CompaniesHouse constructor.
     * @param $key
     * @param $base_uri
     * @throws ApiBaseUriException
     * @throws ApiKeyException
     */

    public function __construct($key, $base_uri)
    {


        if (empty($key) || $key == '') {

            throw new ApiKeyException('Missing ApiKey: CompaniesHouse API Key is required. Please visit https://developer.companieshouse.gov.uk/developer/applications');

        }

        if (empty($base_uri) || $base_uri == '') {

            throw new ApiBaseUriException('Missing ApiBaseUri: CompaniesHouse Base Uri is required. Please visit https://developer.companieshouse.gov.uk/developer/applications');

        }


        $this->base_uri = $base_uri;

        $this->key = $key;

        // initialise guzzle/client

        $this->client = new Client(array(
            'base_uri' => $base_uri,
            'auth' => array($key, '')
        ));


    }

    /**
     * @param $resource
     * @return Company
     * @throws InvalidResourceException
     */

    public function search($resource)
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

    }
}