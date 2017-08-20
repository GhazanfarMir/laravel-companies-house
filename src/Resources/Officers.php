<?php

namespace Ghazanfar\CompaniesHouseApi\Resources;

/**
 * Class Officers
 * @package Ghazanfar\CompaniesHouseApi\Resources
 */

class Officers extends ResourcesBase
{

    /**
     * @param $name
     * @param int $disqualified_flag
     * @param int $items_per_page
     * @param int $start_index
     * @return array|mixed|null|object
     */
    public function byName($name, $disqualified_flag=0, $items_per_page=20, $start_index=0)
    {

        $endpoint = 'search/officers';

        if($disqualified_flag) $endpoint = 'search/disqualified-officers';

        if(!empty($name))
        {
            $params = array(
                'query' => array(
                    'q' => $name,
                    'items_per_page' => $items_per_page,
                    'start_index' => $start_index
                )
            );

            $response = $this->client->request('GET', $endpoint, $params);

            return $this->response($response->getBody());

        } else {

            throw new \InvalidArgumentException('Invalid Argument: You must provide valid officer\'s name to search for.');
        }
    }

}