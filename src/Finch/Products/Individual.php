<?php

namespace Phinch\Finch\Products;

use Phinch\Finch\Paginated;

class Individual extends BaseProduct
{
    protected const PREFIX = 'employer/individual';

    public function search(array $individual_ids): Paginated
    {
        $result = $this->client->post(self::PREFIX, [
            'requests' => array_map(fn ($id) => ['individual_id' => $id], $individual_ids),
        ]);

        return new Paginated($result);
    }
}
