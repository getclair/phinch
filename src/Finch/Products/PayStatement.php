<?php

namespace Phinch\Finch\Products;

use GuzzleHttp\Exception\GuzzleException;
use Phinch\Finch\Paginated;

class PayStatement extends BaseProduct
{
    protected const PREFIX = 'employer/pay-statement';

    /**
     * Read detailed pay statements for each individual.
     * https://developer.tryfinch.com/docs/reference/d5fd02c41e83a-pay-statement
     *
     * @param array $payment_ids
     * @return array
     * @throws GuzzleException
     */
    public function search(array $payment_ids): array
    {
        return $this->responses(
            $this->client->post(self::PREFIX, [
                'requests' => array_map(fn($id) => ['payment_id' => $id], $payment_ids),
            ])
        );
    }
}
