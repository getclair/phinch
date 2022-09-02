<?php

namespace Phinch\Finch\Products;

use GuzzleHttp\Exception\GuzzleException;

class Payment extends BaseProduct
{
    protected const PREFIX = 'employer/payment';

    /**
     * Read payroll and contractor related payments by the company.
     * https://developer.tryfinch.com/docs/reference/b811fdc2542ca-payment
     *
     * @param string $start_date
     * @param string $end_date
     * @return array
     * @throws GuzzleException
     */
    public function search(string $start_date, string $end_date): array
    {
        return $this->client->get(self::PREFIX, [
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    }
}
