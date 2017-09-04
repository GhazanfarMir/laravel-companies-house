<?php

namespace Ghazanfar\CompaniesHouseApi\Resources;

/**
 * Class FillingHistory.
 */
class FilingHistory extends ResourcesBase
{
    /**
     * @param $number
     * @param int $items_per_page
     * @param int $start_index
     * @return array|mixed|null|object
     */
    public function find($number, $items_per_page = 20, $start_index = 0)
    {
        if (! empty($number)) {
            $endpoint = "company/$number/filing-history";

            $params = [
                'items_per_page' => $items_per_page,
                'start_index' => $start_index,
            ];

            return $this->client->get($endpoint, $params);

        } else {
            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company number to search for.');
        }
    }
}
