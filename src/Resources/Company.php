<?php

namespace GhazanfarMir\CompaniesHouse\Resources;

use BadMethodCallException;
use GhazanfarMir\CompaniesHouse\Http\Client;

/**
 * Class Company.
 */
class Company extends ResourcesBase
{
    /**
     * Companies House Number.
     * @var string
     */
    protected $number;

    /**
     * Company constructor.
     * @param Client $client
     * @param $number
     */
    public function __construct(Client $client, $number)
    {
        parent::__construct($client);

        $this->number = $number;
    }

    /**
     * Get specified company details or throw an exception if no company number is defined.
     *
     * @return mixed
     * @throws \Exception
     */
    public function get()
    {
        if (! empty($this->number)) {
            $url = $this->buildResourceUrl('/company/'.$this->number);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new BadMethodCallException('Company number is not provided yet.');
        }
    }

    /**
     * Get specified company's registered address or throw an exception is no number is specified.
     *
     * @return mixed
     * @throws \Exception
     */
    public function registered_office_address()
    {
        if (! empty($this->number)) {
            $uri = "/company/{$this->number}/registered-office-address";

            $url = $this->buildResourceUrl($uri);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new BadMethodCallException('Company number is not provided yet.');
        }
    }

    /**
     * Get specified company's officers or throw an exception if no number is defined.
     *
     * @return array|mixed|null|object
     * @throws \Exception
     */
    public function officers()
    {
        if (! empty($this->number)) {
            $uri = "/company/{$this->number}/officers";

            $url = $this->buildResourceUrl($uri);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new BadMethodCallException('Company number is not provided yet.');
        }
    }

    /**
     * @return array|mixed|null|object
     * @throws \Exception
     */
    public function uk_establishments()
    {
        if (! empty($this->number)) {
            $uri = "/company/{$this->number}/uk-establishments";

            $url = $this->buildResourceUrl($uri);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new BadMethodCallException('Company number is not provided yet.');
        }
    }

    /**
     * Get specified company's registers or throw an exception if no number is defined.
     *
     * @return array|mixed|null|object
     * @throws \Exception
     */
    public function registers()
    {
        if (! empty($this->number)) {
            $uri = "/company/{$this->number}/registers";

            $url = $this->buildResourceUrl($uri);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new BadMethodCallException('Company number is not provided yet.');
        }
    }

    /**
     * Get specified company's exceptions or throw an exception if no number is defined.
     *
     * @return array|mixed|null|object
     * @throws \Exception
     */
    public function exemptions()
    {
        if (! empty($this->number)) {
            $uri = "/company/{$this->number}/exemptions";

            $url = $this->buildResourceUrl($uri);

            $response = $this->client->get($url);

            return $response;
        } else {
            throw new BadMethodCallException('Company number is not provided yet.');
        }
    }
}
