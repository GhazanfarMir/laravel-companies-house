<?php

namespace Ghazanfar\CompaniesHouseApi\Resources;


/**
 * Class Company
 */

class Company extends ResourcesBase
{

    public function all($search)
    {
        if(!empty($search) && $search!='')
        {
            $params = array(
                'query' => array(
                    'q' => $search
                )
            );

            $response = $this->client->request('GET', 'search/', $params);

            return $this->response($response->getBody());
        } else {

            throw new InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }
    }

    /**
     * @param $name
     * @return array|mixed|null|object
     */
    public function byName($name)
    {

        if(!empty($search) && $search!='')
        {
            $params = array(
                'query' => array(
                    'q' => $search
                )
            );

            $response = $this->client->request('GET', 'search/companies', $params);

            return $this->response($response->getBody());
        } else {

            throw new InvalidArgumentException('Invalid Argument: You must provide valid company name to search for.');
        }

    }

    /**
     * @param $number
     * @return array|mixed|null|object
     */
    public function byNumber($number)
    {


        if (!empty($number) && $number != '') {
            $response = $this->client->request('GET', 'company/' . $number);

            return $this->response($response->getBody());

        } else {

            throw new \InvalidArgumentException('Missing Search Term: Company number can not be empty, you must provide a company number to get profile.');

        }

    }

}