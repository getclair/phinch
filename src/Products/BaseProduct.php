<?php

namespace Phinch\Products;

use Phinch\Paginated;
use Phinch\PaginatedInterface;
use Phinch\PhinchClient;

abstract class BaseProduct
{
    /**
     * @param PhinchClient $client
     * @param string|null $paginator
     */
    public function __construct(protected PhinchClient $client, protected ?string $paginator = null)
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

    /**
     * @param array $data
     * @param string|null $resultsKey
     * @return mixed
     */
    protected function paginate(array $data, string $resultsKey = null): mixed
    {
        if(! $this->paginator || ! in_array(PaginatedInterface::class, class_implements($this->paginator))) {
            $this->paginator = Paginated::class;
        }

        return new $this->paginator($data, $resultsKey);
    }
}
