<?php

namespace Phinch\Products;

use Phinch\ApiClient;

abstract class BaseProduct
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }
}
