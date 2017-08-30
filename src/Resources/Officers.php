<?php

namespace Ghazanfar\CompaniesHouseApi\Resources;

/**
 * Class Officers.
 */
class Officers extends ResourcesBase
{
    /**
     * @var int
     */
    protected $disqualified_flag = false;

    /**
     * @var
     */
    protected $endpoint = 'search/officers';

    /**
     * @return $this
     */
    public function disqualified()
    {
        $this->disqualified_flag = true;

        return $this;
    }

    /**
     * @param $name
     * @param int $items_per_page
     * @param int $start_index
     *
     * @return array|mixed|null|object
     *
     * @internal param $disqualified_flag
     */
    public function search($name, $items_per_page = 20, $start_index = 0)
    {
        // check if the disqualified flag is set

        if ($this->disqualified_flag) {
            $this->endpoint = 'search/disqualified-officers';
        }

        if (!empty($name)) {
            $params = [
                'q' => $name,
                'items_per_page' => $items_per_page,
                'start_index' => $start_index,
            ];

            $response = $this->client->get($this->endpoint, $params);

            return json_decode($response);
        } else {
            throw new \InvalidArgumentException('Invalid Argument: You must provide valid officer\'s name to search for.');
        }
    }
}
