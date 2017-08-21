<?php

namespace Ghazanfar\CompaniesHouseApi\Resources;


/**
 * Class Company
 */

class Company extends ResourcesBase
{

    /**
     * Company name
     * @var
     */
    protected $name;

    /**
     * Company number
     * @var
     */
    protected $number;

    /**
     * Company officers
     * @var
     */
    protected $officers;


    /**
     * @param $name
     * @param int $items_per_page
     * @param int $start_index
     * @return array|mixed|null|object
     */
    public function search($name, $items_per_page = 20, $start_index = 0)
    {
        if (!empty($name)) {
            $params = array(
                'query' => array(
                    'q' => $name,
                    'items_per_page' => $items_per_page,
                    'start_index' => $start_index
                )
            );

            $response = $this->client->request('GET', 'search/companies', $params);

            return $this->response($response->getBody());

        } else {

            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }
    }

    /**
     * @param $number
     * @return array|mixed|null|object
     */
    public function find($number)
    {
        if (!empty($number)) {
            $response = $this->client->request('GET', 'company/' . $number);

            return $this->response($response->getBody());

        } else {

            throw new \InvalidArgumentException('Missing Search Term: Company number can not be empty, you must provide a company number to get profile.');

        }
    }

    /**
     * @param $search
     * @param $items_per_page
     * @param $start_index
     * @return array|mixed|null|object
     */
    public function searchAll($search, $items_per_page = 20, $start_index = 0)
    {
        if (!empty($search)) {
            $params = array(
                'query' => array(
                    'q' => $search,
                    'items_per_page' => $items_per_page,
                    'start_index' => $start_index
                )
            );

            $response = $this->client->request('GET', 'search/', $params);

            return $this->response($response->getBody());
        } else {

            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }
    }

}