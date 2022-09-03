<?php

namespace Phinch\Products;

use GuzzleHttp\Exception\GuzzleException;

class Employment extends BaseProduct
{
    protected const PREFIX = 'employer/employment';

    /**
     * Read individual employment and income data
     * https://developer.tryfinch.com/docs/reference/1ba5cdec4c979-employment
     *
     * @param array $individual_ids
     * @return array
     * @throws GuzzleException
     */
    public function search(array $individual_ids): array
    {
        return $this->responses(
            $this->client->post(self::PREFIX, [
                'requests' => array_map(fn($id) => ['individual_id' => $id], $individual_ids),
            ])
        );
    }
}
