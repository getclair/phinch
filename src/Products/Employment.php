<?php

namespace Phinch\Products;

use Phinch\Paginated;

class Employment extends BaseProduct
{
    protected const PREFIX = 'employer/employment';

    public function search(array $individual_ids): Paginated
    {
        $result = $this->client->post(self::PREFIX, [
            'requests' => array_map(fn ($id) => ['individual_id' => $id], $individual_ids),
        ]);

        return new Paginated($result);
    }
}
