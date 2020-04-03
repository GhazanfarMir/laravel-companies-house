<?php

namespace GhazanfarMir\CompaniesHouse\Tests\Features;

use GhazanfarMir\CompaniesHouse\CompaniesHouse;
use GhazanfarMir\CompaniesHouse\Http\Client;
use PHPUnit\Framework\TestCase;

abstract class CompaniesHouseBaseTest extends TestCase
{
    const COMPANIES_BASE_URL = 'https://api.companieshouse.gov.uk/';
    const COMPANIES_API_KEY = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    /** @var string Companies House Api Key. */
    protected $api_key;

    /** @var string Companies House Api Uri. */
    protected $base_uri;

    /** @var Client Companies House package client. */
    protected $client;

    /** @var CompaniesHouse Companies House package. */
    protected $api;

    /** @var string */
    protected $platform;

    /**
     * @test
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->base_uri = self::COMPANIES_BASE_URL;
        $this->api_key = self::COMPANIES_API_KEY;
        $this->client = new Client($this->base_uri, $this->api_key);
        $this->api = new CompaniesHouse($this->client);
        $this->platform = getenv('PLATFORM');

        $this->assertTrue(true);
    }
}
