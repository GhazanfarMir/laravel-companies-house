<?php

namespace GhazanfarMir\CompaniesHouse\Resources;

class Search extends ResourcesBase
{
    /**
     * @param $keyword
     * @param int $items_per_page
     * @param int $start_index
     * @return array|mixed|null|object
     * @internal param $name
     */
    public function all($keyword, $items_per_page = 20, $start_index = 0)
    {
        $url = $this->buildResourceUrl('/search');

        if (! empty($keyword)) {
            $params = [
                'q' => $keyword,
                'items_per_page' => $items_per_page,
                'start_index' => $start_index,
            ];

            return $this->client->get($url, $params);
        } else {
            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }
    }

    /**
     * @param $keyword
     * @param int $items_per_page
     * @param int $start_index
     * @return array|mixed|null|object
     * @internal param $name
     */
    public function companies($keyword, $items_per_page = 20, $start_index = 0)
    {
        $uri = $this->buildResourceUrl('/search/companies/');

        if (! empty($keyword)) {
            $params = [
                'q' => $keyword,
                'items_per_page' => $items_per_page,
                'start_index' => $start_index,
            ];

            return $this->client->get($uri, $params);
        } else {
            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }
    }

    /**
     * @param $keyword
     * @param int $items_per_page
     * @param int $start_index
     * @return array|mixed|null|object
     * @internal param $name
     */
    public function officers($keyword, $items_per_page = 20, $start_index = 0)
    {
        $uri = $this->buildResourceUrl('/search/officers/');

        if (! empty($keyword)) {
            $params = [
                'q' => $keyword,
                'items_per_page' => $items_per_page,
                'start_index' => $start_index,
            ];

            return $this->client->get($uri, $params);
        } else {
            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }
    }

    /**
     * @param $keyword
     * @param int $items_per_page
     * @param int $start_index
     * @return array|mixed|null|object
     * @internal param $name
     */
    public function disqualified_officers($keyword, $items_per_page = 20, $start_index = 0)
    {
        $uri = '/search/disqualified-officers/';

        if (! empty($keyword)) {
            $params = [
                'q' => $keyword,
                'items_per_page' => $items_per_page,
                'start_index' => $start_index,
            ];

            return $this->client->get($this->base_uri.$uri, $params);
        } else {
            throw new \InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }
    }
}
