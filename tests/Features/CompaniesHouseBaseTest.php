<?php

namespace GhazanfarMir\CompaniesHouse\Tests\Features;

use PHPUnit\Framework\TestCase;
use GhazanfarMir\CompaniesHouse\Http\Client;
use GhazanfarMir\CompaniesHouse\CompaniesHouse;

abstract class CompaniesHouseBaseTest extends TestCase
{
    /**
     * @var string
     */
    protected $api_key = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    /**
     * @var string
     */
    protected $base_uri = 'https://api.companieshouse.gov.uk/';

    /**
     * @var
     */
    protected $client;

    /**
     * @var
     */
    protected $api;

    /**
     * @var
     */
    protected $platform;

    /**
     * @test
     */
    public function setUp(): void 
    {
        parent::setUp();

        $this->client = new Client($this->base_uri, $this->api_key);

        $this->api = new CompaniesHouse($this->client);

        $this->platform = getenv('PLATFORM');
    }
}
