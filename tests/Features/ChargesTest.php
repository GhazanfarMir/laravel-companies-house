<?php

namespace GhazanfarMir\CompaniesHouse\Tests\Features;

class ChargesTest extends CompaniesHouseBaseTest
{
    /**
     * @var string
     */
    protected $number = '07086058';

    /**
     * @test
     */
    public function get_company_charges()
    {
        if ($this->platform == 'travis') {
            $this->assertTrue(true);
            return;
        }

        $charges = $this->api->charges($this->number)->all();

        $this->assertArrayHasKey('unfiltered_count', (array) $charges);
        $this->assertArrayHasKey('delivered_on', (array) $charges->items[0]);
        $this->assertArrayHasKey('persons_entitled', (array) $charges->items[0]);
    }

    /**
     * @test
     */
    public function get_company_charges_by_id()
    {
        $chargesId = 'kCCyVBzHTmTBbsMxWth2GeLy4x8';

        if ($this->platform == 'travis') {
            $this->assertTrue(true);
            return;
        }

        $charges = $this->api->charges($this->number)->find($chargesId);

        $this->assertArrayHasKey('charge_number', (array) $charges);
        $this->assertArrayHasKey('transactions', (array) $charges);
        $this->assertArrayHasKey('particulars', (array) $charges);
    }
}
