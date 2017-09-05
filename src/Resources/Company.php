<?php

namespace GhazanfarMir\CompaniesHouse\Resources;

/**
 * Class Company.
 */
class Company extends ResourcesBase
{
    /**
     * Company number.
     * @var
     */
    protected $number;

    /**
     * @param $number
     *
     * @return $this
     */
    public function find($number)
    {
        if (!empty($number)) {

            $this->number = $number;

            return $this;

        } else {

            throw new \InvalidArgumentException('Company number can not be empty, you must provide a company number.');
        }
    }

    /**
     * @return array|mixed|null|object
     */
    public function get()
    {
        if (!empty($this->number)) {

            $url = $this->buildResourceUrl('/company/' . $this->number);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new \BadMethodCallException('Company number is not provided yet.');
        }
    }

    /**
     * @test
     */
    public function registered_office_address()
    {
        if (!empty($this->number)) {

            $uri = "/company/{$this->number}/registered-office-address";

            $url = $this->buildResourceUrl($uri);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new \BadMethodCallException('Company number is not provided yet.');
        }
    }

    /**
     * @return array|mixed|null|object
     */
    public function officers()
    {
        if (!empty($this->number)) {

            $uri = "/company/{$this->number}/officers";

            $url = $this->buildResourceUrl($uri);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new \BadMethodCallException('Company number is not provided yet.');
        }
    }

    /**
     * @return array|mixed|null|object
     */
    public function uk_establishments()
    {
        if (!empty($this->number)) {

            $uri = "/company/{$this->number}/uk-establishments";

            $url = $this->buildResourceUrl($uri);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new \BadMethodCallException('Company number is not provided yet.');
        }
    }

    /**
     * @return array|mixed|null|object
     */
    public function registers()
    {
        if (!empty($this->number)) {

            $uri = "/company/{$this->number}/registers";

            $url = $this->buildResourceUrl($uri);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new \BadMethodCallException('Company number is not provided yet.');
        }
    }

    /**
     * @return array|mixed|null|object
     */
    public function exemptions()
    {
        if (!empty($this->number)) {

            $uri = "/company/{$this->number}/exemptions";

            $url = $this->buildResourceUrl($uri);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new \BadMethodCallException('Company number is not provided yet.');
        }
    }
}
