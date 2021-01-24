<?php

namespace Phinch\Finch\Products;

use Phinch\Finch\FinchClient;

abstract class BaseProduct
{
    protected FinchClient $client;

    public function __construct(FinchClient $client)
    {
        $this->client = $client;
    }
}
