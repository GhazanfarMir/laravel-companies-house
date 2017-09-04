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
    protected $filing_history;

    /**
     * Get other resources within the array
     * @var
     */
    protected $with;

    /**
     * Get all other resources except the ones in the array
     * @var
     */
    protected $without;

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
        if (!empty($name)) {
            $params = [
                'q' => $name,
                'items_per_page' => $items_per_page,
                'start_index' => $start_index,
            ];

            return $this->client->get('search/companies', $params);

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

        if (!empty($number)) {
            $this->info = $this->client->get($base);

            if (count($this->with)) {
                foreach ($this->with as $resource) {
                    if (!in_array($resource, $this->valid_resources)) {
                        $valid_resource_string = implode(', ', $this->valid_resources);

                        throw new InvalidArgumentException("Invalid resource ($resource). You must provide a valid company resource. e.g. $valid_resource_string.");
                    }

                    // endpoint uses hyphens, so we need to adjust hyphens here
                    $endpoint = str_replace('_', '-', $resource);

                    $this->$resource = $this->client->get($base . "/$endpoint");
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

            return $response;
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

        return $this->info;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {

        $property = $this->normaliseProperties($name);
        if (property_exists($this, $property)) {

            if (isset($this->$property) && ! empty($this->$property)) {
                return $this->$property;
            }
        }

    }

    /**
     * @param $camel
     * @param string $splitter
     * @return string
     */
    function normaliseProperties($camel, $splitter = "_")
    {
        $camel = preg_replace('/(?!^)[[:upper:]][[:lower:]]/', '$0', preg_replace('/(?!^)[[:upper:]]+/', $splitter . '$0', $camel));

        return strtolower($camel);

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
