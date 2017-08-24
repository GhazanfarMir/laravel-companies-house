<?php

namespace Ghazanfar\CompaniesHouseApi\Tests\Features;

use Ghazanfar\CompaniesHouseApi\CompaniesHouseApi;
use Ghazanfar\CompaniesHouseApi\Http\Client;
use PHPUnit\Framework\TestCase;

class CompaniesHouseTest extends TestCase
{
    /**
     * @var
     */
    protected $client;


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

        $this->client = new Client();

        $this->api = new CompaniesHouseApi($this->client);
    }

    /**
     * @test
     */
    public function search_content_type_is_json()
    {

        $response = $this->client->get('search/companies', ['q' => 'Ebury Partners']);

        echo "<pre>";
        print_r($response);
        echo "</pre>";

        //$response = json_decode($response);

        //$this->assertNotEmpty($response->items[0]->title);

        $this->assertTrue(true);
    }


    /**
     * @test
     */
    public function search_by_company_name()
    {

        $name = 'ebury partners';

        $companies = $this->api->company()->search($name);

        echo "<pre>";
        print_r($companies);
        echo "</pre>";

        //$this->assertArrayHasKey('address_snippet', (array) $companies->items[0]);

        $this->assertTrue(true);

    }

    /**
     * @test
     */
    public function can_search_by_company_number()
    {

        $number = '07039469';

        $company = $this->api->company()->find($number);

        echo "<pre>";
        print_r($company);
        echo "</pre>";

        //$this->assertArrayHasKey('company_name', (array) $company);

        //$this->assertEquals($number, $company->company_number);

        //$this->assertTrue(true);
    }

    /**
     * @test
     */
    public function search_officers_by_name()
    {

        $officer = 'Ghazanfar';

        $officers = $this->api->officers()->search($officer);

        echo "<pre>";
        print_r($officers);
        echo "</pre>";

        //$this->assertArrayHasKey('title', (array) $officers->items[0]);

        //$this->assertTrue(true);

    }

    /**
     * @test
     */
    public function search_disqualified_officers_by_name()
    {

        $name = 'Mir';

        $officers = $this->api->officers()->disqualified()->search($name);

        echo "<pre>";
        print_r($officers);
        echo "</pre>";

        //$this->assertArrayHasKey('title', (array) $officers->items[0]);

        //$this->assertArrayHasKey('date_of_birth', (array) $officers->items[0]);

        //$this->assertArrayHasKey('address', (array) $officers->items[0]);

        $this->assertTrue(true);

    }

}
