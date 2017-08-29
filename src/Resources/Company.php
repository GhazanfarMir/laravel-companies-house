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
     * @var
     */
    protected $info;


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
                'q' => $name,
                'items_per_page' => $items_per_page,
                'start_index' => $start_index
            );

            $response = $this->client->get('search/companies', $params);

            return json_decode($response);

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

            $this->info = $this->client->get('company/' . $number);

            return $this;

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
                'q' => $search,
                'items_per_page' => $items_per_page,
                'start_index' => $start_index
            );

            $response = $this->client->get('search/', $params);

            return json_decode($response);

        } else {

            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }
    }

    /**
     * @return array|bool|mixed|null|object
     */
    public function get()
    {

        if(empty($this->info))
        {
            return false;
        }

        return json_decode($this->info);
    }

    /**
     * @return array
     */
    public function officers()
    {

        if(empty($this->officers))
        {
            return [];
        }

        return json_decode($this->officers);
    }

}