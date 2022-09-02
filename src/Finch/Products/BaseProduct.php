<?php

namespace Phinch\Finch\Products;

use Phinch\Finch\FinchClient;

abstract class BaseProduct
{
    /**
     * @param FinchClient $client
     */
    public function __construct(protected FinchClient $client)
    {
    }

    /**
     * @param array $result
     * @return array
     */
    protected function responses(array $result): array
    {
        return array_key_exists('responses', $result) ? $result['responses'] : [];
    }
}
