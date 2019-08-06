<?php

namespace GhazanfarMir\CompaniesHouse\Resources;

use GhazanfarMir\CompaniesHouse\Http\Client;
use Prophecy\Exception\InvalidArgumentException;

/**
 * Class FillingHistory.
 */
class FilingHistory extends ResourcesBase
{
    /**
     * Companies House number.
     * @var string
     */
    protected $number;

    /**
     * FilingHistory constructor.
     * @param Client $client
     * @param $number
     */
    public function __construct(Client $client, $number)
    {
        parent::__construct($client);

        $this->number = $number;
    }

    /**
     * Get paginated filing history for the specified company or throw an
     * exception if no company number is defined.
     *
     * @param int $items_per_page
     * @param int $start_index
     * @return array|mixed|null|object
     * @throws \Exception
     */
    public function all($items_per_page = 20, $start_index = 0)
    {
        if (! empty($this->number)) {
            $uri = "/company/$this->number/filing-history";

            $url = $this->buildResourceUrl($uri);

            $params = [
                'items_per_page' => $items_per_page,
                'start_index' => $start_index,
            ];

            return $this->client->get($url, $params);
        } else {
            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company number to search for.');
        }
    }

    /**
     * Get transaction by transaction id for a specified company or throw an exception.
     *
     * @param $transaction_id
     * @return array|mixed|null|object
     * @throws \Exception
     */
    public function find($transaction_id)
    {
        if (empty($transaction_id)) {
            throw new InvalidArgumentException('You must provide a transactionId.');
        }

        if (! empty($this->number)) {
            $uri = "/company/$this->number/filing-history/$transaction_id";

            $url = $this->buildResourceUrl($uri);

            return $this->client->get($url);
        } else {
            throw new InvalidArgumentException('Invalid Argument: You must provide valid company number to search for.');
        }
    }
}
