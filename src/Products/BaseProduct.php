<?php

namespace Phinch\Products;

use Phinch\PhinchClient;

abstract class BaseProduct
{
    /**
     * @param PhinchClient $client
     */
    public function __construct(protected PhinchClient $client)
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
