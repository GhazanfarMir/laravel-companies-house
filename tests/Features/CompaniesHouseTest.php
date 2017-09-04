<?php

namespace Ghazanfar\CompaniesHouseApi\Tests\Features;

use PHPUnit\Framework\TestCase;
use Ghazanfar\CompaniesHouseApi\Http\Client;
use Ghazanfar\CompaniesHouseApi\CompaniesHouseApi;

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
     * Setup.
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
        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $response = $this->client->get('search/companies', ['q' => 'Ebury Partners']);

        $this->assertNotEmpty($response->items[0]->title);
    }

    /**
     * @test
     */
    public function search_by_company_name()
    {
        $name = 'ebury partners';

        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $companies = $this->api->company()->search($name);

        $this->assertArrayHasKey('address_snippet', (array) $companies->items[0]);
    }

    /**
     * @test
     */
    public function can_search_by_company_number()
    {
        $number = '07039469';

        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $company = $this->api->company()->find($number)->get();

        $this->assertArrayHasKey('company_name', (array) $company);

        $this->assertEquals($number, $company->company_number);
    }

    /**
     * @test
     */
    public function search_officers_by_name()
    {
        $officer = 'Ghazanfar';

        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $officers = $this->api->officers()->search($officer);

        $this->assertArrayHasKey('title', (array) $officers->items[0]);
    }

    /**
     * @test
     */
    public function search_disqualified_officers_by_name()
    {
        $name = 'Mir';

        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $officers = $this->api->officers()->disqualified()->search($name);

        $this->assertArrayHasKey('title', (array) $officers->items[0]);

        $this->assertArrayHasKey('date_of_birth', (array) $officers->items[0]);

        $this->assertArrayHasKey('address', (array) $officers->items[0]);
    }

    /**
     * @test
     */
    public function get_list_of_filing_history()
    {
        $number = '07039469';

        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $history = $this->api->filingHistory()->find($number);

        $this->assertArrayHasKey('paper_filed', (array) $history->items[0]);

        $this->assertArrayHasKey('transaction_id', (array) $history->items[0]);

    }
}
