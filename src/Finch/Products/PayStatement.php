<?php

namespace Phinch\Finch\Products;

use Phinch\Finch\Paginated;
use Phinch\Finch\Products\BaseProduct;

class PayStatement extends BaseProduct
{
    protected const PREFIX = 'employer/pay-statement';

    public function search(array $payment_ids): Paginated
    {
        $result = $this->client->post(self::PREFIX, [
            'requests' => array_map(fn ($id) => ['payment_id' => $id], $payment_ids),
        ]);

        return new Paginated($result);
    }
}
