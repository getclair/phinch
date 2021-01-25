<?php

namespace Phinch\Finch\Products;

class Company extends BaseProduct
{
    protected const PREFIX = 'employer/company';

    public function view(): array
    {
        return $this->client->get(self::PREFIX);
    }
}
