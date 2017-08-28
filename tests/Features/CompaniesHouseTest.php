<?php

namespace Ghazanfar\CompaniesHouseApi\Tests\Features;

use Ghazanfar\CompaniesHouseApi\CompaniesHouseApi;
use Ghazanfar\CompaniesHouseApi\Http\Client;
use PHPUnit\Framework\TestCase;

class CompaniesHouseTest extends TestCase
{

    /**
     * @var string
     */
    protected $api_key;

    /**
     * @var string
     */
    protected $base_uri;

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
     * Setup
     */
    public function setUp()
    {
        parent::setUp();

        $this->api_key = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

        $this->base_uri = 'https://api.companieshouse.gov.uk/';

        $this->client = new Client($this->base_uri, $this->api_key);

        $this->api = new CompaniesHouseApi($this->client);

        $this->platform = getenv('PLATFORM');
    }

    /**
     * @test
     */
    public function search_content_type_is_json()
    {

        if($this->platform!='travis') {

            $response = $this->client->get('search/companies', ['q' => 'Ebury Partners']);

            $response = json_decode($response);

            $this->assertNotEmpty($response->items[0]->title);

        }
        $this->assertTrue(true);
    }


    /**
     * @test
     */
    public function search_by_company_name()
    {

        $name = 'ebury partners';

        if($this->platform!='travis') {

            $companies = $this->api->company()->search($name);

            $this->assertArrayHasKey('address_snippet', (array)$companies->items[0]);

        }

        $this->assertTrue(true);

    }

    /**
     * @test
     */
    public function can_search_by_company_number()
    {

        $number = '07039469';

        if($this->platform!='travis') {

            $company = $this->api->company()->find($number)->get();

            $this->assertArrayHasKey('company_name', (array)$company);

            $this->assertEquals($number, $company->company_number);

        }

        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function search_officers_by_name()
    {

        $officer = 'Ghazanfar';

        if($this->platform!='travis') {

            $officers = $this->api->officers()->search($officer);

            $this->assertArrayHasKey('title', (array)$officers->items[0]);

        }

        $this->assertTrue(true);

    }

    /**
     * @test
     */
    public function search_disqualified_officers_by_name()
    {

        $name = 'Mir';

        if($this->platform!='travis') {

            $officers = $this->api->officers()->disqualified()->search($name);

            $this->assertArrayHasKey('title', (array)$officers->items[0]);

            $this->assertArrayHasKey('date_of_birth', (array)$officers->items[0]);

            $this->assertArrayHasKey('address', (array)$officers->items[0]);

        }

        $this->assertTrue(true);

    }

}
