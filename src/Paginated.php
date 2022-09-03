<?php

namespace Phinch;

class Paginated
{
    /**
     * Paginated constructor.
     *
     * @param array $data
     * @param string|null $resultsKey
     */
    public function __construct(protected array $data, protected ?string $resultsKey = null)
    {
    }

    /**
     * Pagination metadata.
     *
     * @return array
     */
    public function meta(): array
    {
        return $this->data['paging'];
    }

    /**
     * Pagination results.
     *
     * @return array
     */
    public function results(): array
    {
        if($this->resultsKey && array_key_exists($this->resultsKey, $this->data)) {
            return $this->data[$this->resultsKey];
        }

        $data = $this->data;

        unset($data['paging']);

        $data = array_values($data);

        return array_shift($data);
    }
}
