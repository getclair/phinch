<?php

namespace Phinch\Finch\Products;

class Payment extends BaseProduct
{
    protected const PREFIX = 'employer/payment';

    public function search(string $start_date, string $end_date): array
    {
        return $this->client->get(self::PREFIX, [
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    }
}
