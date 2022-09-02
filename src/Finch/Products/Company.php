<?php

namespace Phinch\Finch\Products;

use GuzzleHttp\Exception\GuzzleException;

class Company extends BaseProduct
{
    protected const PREFIX = 'employer/company';

    /**
     * https://developer.tryfinch.com/docs/reference/33162be1eed72-company
     *
     * @return array
     * @throws GuzzleException
     */
    public function view(): array
    {
        return $this->client->get(self::PREFIX);
    }
}
