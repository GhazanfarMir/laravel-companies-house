<?php

namespace GhazanfarMir\CompaniesHouse\Tests\Features;


class FilingHistoryTest extends CompaniesHouseBaseTest
{
    /**
     * @var string
     */
    protected $number = '07086058';

    /**
     * @test
     */
    public function get_company_filing_history()
    {
        if ($this->platform == 'travis') {
            $this->assertTrue(true);
            return;
        }

        $history = $this->api->filingHistory($this->number)->all();

        $this->assertArrayHasKey('total_count', (array) $history);
        $this->assertArrayHasKey('description', (array) $history->items[0]);
        $this->assertArrayHasKey('transaction_id', (array) $history->items[0]);

    }

    /**
     * @test
     */
    public function get_company_filing_transaction_by_id()
    {
        $transactionId = 'MzE4MjE3NzM2MGFkaXF6a2N4';

        if ($this->platform == 'travis') {
            $this->assertTrue(true);
            return;
        }

        $transaction = $this->api->filingHistory($this->number)->find($transactionId);

        $this->assertArrayHasKey('paper_filed', (array) $transaction);
        $this->assertArrayHasKey('description', (array) $transaction);
        $this->assertArrayHasKey('transaction_id', (array) $transaction);
        $this->assertEquals($transaction->transaction_id, $transactionId);
    }

}
