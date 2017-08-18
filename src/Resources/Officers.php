<?php


namespace Ghazanfar\CompaniesHouseApi\Resources;


class Officers extends ResourcesBase
{

    /**
     * @param $name
     * @param int $disqualified_flag
     * @return array|mixed|null|object
     */
    public function byName($name, $disqualified_flag=0)
    {

        $endpoint = 'search/officers';

        if($disqualified_flag) $endpoint = 'search/disqualified-officers';

        if(!empty($name))
        {
            $params = array(
                'query' => array(
                    'q' => $name
                )
            );

            $response = $this->client->request('GET', $endpoint, $params);

            return $this->response($response->getBody());

        } else {

            throw new \InvalidArgumentException('Invalid Argument: You must provide valid officer\'s name to search for.');
        }
    }

}