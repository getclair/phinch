<?php

namespace Phinch\Finch\Products;

use Phinch\Finch\Products\BaseProduct;

class Company extends BaseProduct
{
    protected const PREFIX = 'employer/company';

    public function view(): array
    {
        return $this->client->get(self::PREFIX);
    }
}
