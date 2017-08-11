<?php

namespace Ghazanfar\CompaniesHouse\Tests\Features;

use Ghazanfar\CompaniesHouse\CompaniesHouse;
use PHPUnit\Framework\TestCase;

class CompaniesHouseTest extends TestCase
{

    /**
     * API KEY used for testing
     */

    const API_KEY = 'IvSp6uE13FPbE8iDPx6Yey9aQ64jH3Cvm18eAE_N';

    /**
     * @var
     */
    protected $company;


    /**
     * Setup
     */
    public function setUp()
    {
        parent::setUp();

        $this->company = new CompaniesHouse(self::API_KEY);
    }

    /**
     * @test
     */
    public function search_content_type_is_json()
    {
        $response = $this->company->search('ebury');

        $this->assertEquals('application/json', $response->getHeaders()["Content-Type"][0]);
    }


    /**
     * @test
     */
    public function search_by_company_name()
    {

        $name = 'ebury partners';

        $response = $this->company->search($name);

        $this->assertEquals($response->getStatusCode(), 200);

        $this->assertEquals('application/json', $response->getHeaders()["Content-Type"][0]);

        //$array = json_decode($response->getBody());


    }

    /**
     * @test
     */
    public function can_search_by_company_number()
    {

        $number = '07039469';

        $response = $this->company->searchByNumber($number);

        $this->assertEquals(200, $response->getStatusCode());

    }

}
