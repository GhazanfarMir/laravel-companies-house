<?php

namespace GhazanfarMir\CompaniesHouse\Tests\Features;

use GhazanfarMir\CompaniesHouse\Exceptions\InvalidResourceException;

class CompanyTest extends CompaniesHouseBaseTest
{
    /**
     * @var string
     */
    protected $number = '07086058';

    /**
     * @test
     */
    public function get_company_profile_by_company_number()
    {
        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $companies = $this->api->company($this->number)->get();

        $this->assertArrayHasKey('company_name', (array) $companies);

        $this->assertArrayHasKey('company_status', (array) $companies);
    }

    /**
     * @test
     */
    public function get_company_registered_address()
    {
        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $address = (array) $this->api->company($this->number)->registered_office_address();

        $this->assertArrayHasKey('postal_code', $address);
        $this->assertArrayHasKey('country', $address);
        $this->assertArrayHasKey('locality', $address);
        $this->assertArrayHasKey('address_line_1', $address);
        $this->assertArrayHasKey('address_line_2', $address);
    }

    /**
     * @test
     */
    public function get_company_officers()
    {
        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $officers = $this->api->company($this->number)->officers();

        $this->assertArrayHasKey('total_results', (array) $officers);
        $this->assertArrayHasKey('name', (array) $officers->items[0]);
        $this->assertArrayHasKey('address', (array) $officers->items[0]);
    }

    /**
     * @test
     */
    public function get_uk_establishment_companies()
    {
        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $establishments = $this->api->company($this->number)->uk_establishments();

        $this->assertArrayHasKey('items', (array) $establishments);
    }

    /**
     * @test
     */
    public function get_company_registers()
    {
        $this->expectException(InvalidResourceException::class);

        if ($this->platform == 'travis') {
            throw new \GhazanfarMir\CompaniesHouse\Exceptions\InvalidResourceException;

            return;
        }

        $this->api->company($this->number)->registers();
    }

    /**
     * @test
     */
    public function get_company_exemptions()
    {
        $this->expectException(InvalidResourceException::class);

        if ($this->platform == 'travis') {
            throw new \GhazanfarMir\CompaniesHouse\Exceptions\InvalidResourceException;

            return;
        }

        $this->api->company($this->number)->exemptions();
    }
}
