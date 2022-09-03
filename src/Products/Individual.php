<?php

namespace Phinch\Products;

use GuzzleHttp\Exception\GuzzleException;

class Individual extends BaseProduct
{
    protected const PREFIX = 'employer/individual';

    /**
     * Read individual data, excluding income and employment data
     * https://developer.tryfinch.com/docs/reference/9d6c83b09e205-individual
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
