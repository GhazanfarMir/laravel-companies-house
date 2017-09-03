<?php

namespace Ghazanfar\CompaniesHouseApi\Resources;

use Prophecy\Exception\InvalidArgumentException;

/**
 * Class Company.
 */
class Company extends ResourcesBase
{
    /**
     * Company name.
     * @var
     */
    protected $name;

    /**
     * Company number.
     * @var
     */
    protected $number;

    /**
     * Company officers.
     * @var
     */
    protected $officers;

    /**
     * @var
     */
    protected $info;

    /**
     * @var
     */
    protected $filings;

    /**
     * @var
     */
    protected $documents;

    /**
     * @var
     */
    protected $registered_office_address;

    /**
     * @var
     */
    protected $with;

    /**
     * @var
     */
    protected $valid_resources = [
        'officers',
        'filing_history',
        'registered_office_address',
        'charges',
    ];

    /**
     * @param $name
     * @param int $items_per_page
     * @param int $start_index
     *
     * @return array|mixed|null|object
     */
    public function search($name, $items_per_page = 20, $start_index = 0)
    {
        if (! empty($name)) {
            $params = [
                'q' => $name,
                'items_per_page' => $items_per_page,
                'start_index' => $start_index,
            ];

            $response = $this->client->get('search/companies', $params);

            return $this->response($response);
        } else {
            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }
    }

    /**
     * @param $number
     *
     * @return $this
     */
    public function find($number)
    {
        $base = "company/$number";

        if (! empty($number)) {
            $this->info = $this->client->get($base);

            if (count($this->with)) {
                foreach ($this->with as $resource) {
                    if (! in_array($resource, $this->valid_resources)) {
                        $valid_resource_string = implode(', ', $this->valid_resources);

                        throw new InvalidArgumentException("Invalid resource ($resource). You must provide a valid company resource. e.g. $valid_resource_string.");
                    }

                    $endpoint = str_replace('_', '-', $resource);

                    $this->$resource = $this->client->get($base."/$endpoint");
                }
            }

            return $this;
        } else {
            throw new \InvalidArgumentException('Missing Search Term: Company number can not be empty, you must provide a company number to get profile.');
        }
    }

    /**
     * @param $search
     * @param $items_per_page
     * @param $start_index
     *
     * @return array|mixed|null|object
     */
    public function searchAll($search, $items_per_page = 20, $start_index = 0)
    {
        if (! empty($search)) {
            $params = [
                'q' => $search,
                'items_per_page' => $items_per_page,
                'start_index' => $start_index,
            ];

            $response = $this->client->get('search/', $params);

            return $this->response($response);
        } else {
            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }
    }

    /**
     * @return array|bool|mixed|null|object
     */
    public function get()
    {
        if (empty($this->info)) {
            return false;
        }

        return $this->response($this->info);
    }

    /**
     * @return array
     */
    public function officers()
    {
        if (empty($this->officers)) {
            return [];
        }

        return $this->response($this->officers);
    }

    /**
     * @return array|mixed
     */
    public function charges()
    {
        if (empty($this->charges)) {
            return [];
        }

        return $this->response($this->charges);
    }

    /**
     * @return mixed
     */
    public function registeredOfficeAddress()
    {
        if (empty($this->registered_office_address)) {
            return [];
        }

        return $this->response($this->registered_office_address);
    }

    /**
     * @param $resources
     *
     * @return $this
     */
    public function with($resources)
    {
        if (! is_array($resources)) {
            $resources = (array) $resources;
        }

        $this->with = $resources;

        return $this;
    }
}
