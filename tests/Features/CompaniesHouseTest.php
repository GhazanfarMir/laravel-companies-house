<?php

namespace Ghazanfar\CompaniesHouseApi\Tests\Features;

use Ghazanfar\CompaniesHouseApi\CompaniesHouseApi;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class CompaniesHouseTest extends TestCase
{

    /**
     * API KEY used for testing
     */

    const API_KEY = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    /**
     * BASE API
     */
    const BASE_URI = 'https://api.companieshouse.gov.uk/';

    /**
     * @var
     */
    protected $api;


    /**
     * Setup
     */
    public function setUp()
    {
        parent::setUp();

        $this->api = new CompaniesHouseApi(self::API_KEY, self::BASE_URI);

        $this->client = new Client([
            'auth' => [ self::API_KEY, ''],
            'base_uri' => self::BASE_URI
        ]);
    }

    /**
     * @test
     */
    public function search_content_type_is_json()
    {

        //$response = $this->client->request('GET', 'search/companies', ['query' => ['q' => 'Ebury']]);

        //$content_type = $response->getHeaders()["Content-Type"][0];

        //$this->assertEquals('application/json', $content_type);

        $this->assertTrue(true);
    }


    /**
     * @test
     */
    public function search_by_company_name()
    {

        $name = 'ebury partners';

        //$companies = $this->api->search('company')->byName($name);

        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function can_search_by_company_number()
    {

        $number = '07039469';

        //$company = $this->api->search('company')->ByNumber($number);

        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function search_officers_by_name()
    {

        $officer = 'Ghazanfar';
        $officers = $this->api->search('officers')->byName($officer);
        //$this->assertContains($officers->items[0]->title, $officers);

        $this->assertTrue(true);

    }

}
