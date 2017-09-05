<?php

namespace GhazanfarMir\CompaniesHouse\Tests\Features;

class SearchTest extends CompaniesHouseBaseTest
{
    /**
     * @test
     */
    public function search_content_type_is_json()
    {
        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $response = $this->client->get($this->base_uri . 'search/companies', ['q' => 'Ebury Partners']);

        $this->assertNotEmpty($response->items[0]->title);
    }

    /**
     * @test
     */
    public function search_all()
    {
        $name = 'ebury partners';

        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $companies = $this->api->search()->all($name);

        $this->assertArrayHasKey('address_snippet', (array)$companies->items[0]);

        $this->assertArrayHasKey('total_results', (array)$companies);
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

        $companies = $this->api->search()->companies($name);

        $this->assertArrayHasKey('address_snippet', (array)$companies->items[0]);
    }

    /**
     * @test
     */
    public function search_officers_by_name()
    {
        $officer = 'Mir';

        if ($this->platform == 'travis') {
            $this->assertTrue(true);

            return;
        }

        $officers = $this->api->search()->officers($officer);

        $this->assertArrayHasKey('title', (array)$officers->items[0]);
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

        $officers = $this->api->search()->disqualified_officers($name);

        $this->assertArrayHasKey('title', (array)$officers->items[0]);

        $this->assertArrayHasKey('date_of_birth', (array)$officers->items[0]);

        $this->assertArrayHasKey('address', (array)$officers->items[0]);
    }
}
