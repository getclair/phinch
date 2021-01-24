<?php

namespace Phinch\Products;

use Phinch\FinchClient;

abstract class BaseProduct
{
    protected FinchClient $client;

    public function __construct(FinchClient $client)
    {
        $this->client = $client;
    }
}
